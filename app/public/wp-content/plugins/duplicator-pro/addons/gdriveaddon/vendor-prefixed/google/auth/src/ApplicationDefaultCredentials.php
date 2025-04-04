<?php

/*
 * Copyright 2015 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace VendorDuplicator\Google\Auth;

use DomainException;
use VendorDuplicator\Google\Auth\Credentials\AppIdentityCredentials;
use VendorDuplicator\Google\Auth\Credentials\GCECredentials;
use VendorDuplicator\Google\Auth\Credentials\ServiceAccountCredentials;
use VendorDuplicator\Google\Auth\HttpHandler\HttpClientCache;
use VendorDuplicator\Google\Auth\HttpHandler\HttpHandlerFactory;
use VendorDuplicator\Google\Auth\Middleware\AuthTokenMiddleware;
use VendorDuplicator\Google\Auth\Middleware\ProxyAuthTokenMiddleware;
use VendorDuplicator\Google\Auth\Subscriber\AuthTokenSubscriber;
use VendorDuplicator\GuzzleHttp\Client;
use InvalidArgumentException;
use VendorDuplicator\Psr\Cache\CacheItemPoolInterface;
/**
 * ApplicationDefaultCredentials obtains the default credentials for
 * authorizing a request to a Google service.
 *
 * Application Default Credentials are described here:
 * https://developers.google.com/accounts/docs/application-default-credentials
 *
 * This class implements the search for the application default credentials as
 * described in the link.
 *
 * It provides three factory methods:
 * - #get returns the computed credentials object
 * - #getSubscriber returns an AuthTokenSubscriber built from the credentials object
 * - #getMiddleware returns an AuthTokenMiddleware built from the credentials object
 *
 * This allows it to be used as follows with GuzzleHttp\Client:
 *
 * ```
 * use Google\Auth\ApplicationDefaultCredentials;
 * use GuzzleHttp\Client;
 * use GuzzleHttp\HandlerStack;
 *
 * $middleware = ApplicationDefaultCredentials::getMiddleware(
 *     'https://www.googleapis.com/auth/taskqueue'
 * );
 * $stack = HandlerStack::create();
 * $stack->push($middleware);
 *
 * $client = new Client([
 *     'handler' => $stack,
 *     'base_uri' => 'https://www.googleapis.com/taskqueue/v1beta2/projects/',
 *     'auth' => 'google_auth' // authorize all requests
 * ]);
 *
 * $res = $client->get('myproject/taskqueues/myqueue');
 * ```
 */
class ApplicationDefaultCredentials
{
    /**
     * Obtains an AuthTokenSubscriber that uses the default FetchAuthTokenInterface
     * implementation to use in this environment.
     *
     * If supplied, $scope is used to in creating the credentials instance if
     * this does not fallback to the compute engine defaults.
     *
     * @param string|array scope the scope of the access request, expressed
     *        either as an Array or as a space-delimited String.
     * @param callable $httpHandler callback which delivers psr7 request
     * @param array $cacheConfig configuration for the cache when it's present
     * @param CacheItemPoolInterface $cache A cache implementation, may be
     *        provided if you have one already available for use.
     * @return AuthTokenSubscriber
     * @throws DomainException if no implementation can be obtained.
     */
    public static function getSubscriber($scope = null, $httpHandler = null, $cacheConfig = null, $cache = null)
    {
        $creds = self::getCredentials($scope, $httpHandler, $cacheConfig, $cache);
        return new AuthTokenSubscriber($creds, $httpHandler);
    }
    /**
     * Obtains an AuthTokenMiddleware that uses the default FetchAuthTokenInterface
     * implementation to use in this environment.
     *
     * If supplied, $scope is used to in creating the credentials instance if
     * this does not fallback to the compute engine defaults.
     *
     * @param string|array scope the scope of the access request, expressed
     *        either as an Array or as a space-delimited String.
     * @param callable $httpHandler callback which delivers psr7 request
     * @param array $cacheConfig configuration for the cache when it's present
     * @param CacheItemPoolInterface $cache A cache implementation, may be
     *        provided if you have one already available for use.
     * @param string $quotaProject specifies a project to bill for access
     *   charges associated with the request.
     * @return AuthTokenMiddleware
     * @throws DomainException if no implementation can be obtained.
     */
    public static function getMiddleware($scope = null, $httpHandler = null, $cacheConfig = null, $cache = null, $quotaProject = null)
    {
        $creds = self::getCredentials($scope, $httpHandler, $cacheConfig, $cache, $quotaProject);
        return new AuthTokenMiddleware($creds, $httpHandler);
    }
    /**
     * Obtains the default FetchAuthTokenInterface implementation to use
     * in this environment.
     *
     * @param string|array $scope the scope of the access request, expressed
     *        either as an Array or as a space-delimited String.
     * @param callable $httpHandler callback which delivers psr7 request
     * @param array $cacheConfig configuration for the cache when it's present
     * @param CacheItemPoolInterface $cache A cache implementation, may be
     *        provided if you have one already available for use.
     * @param string $quotaProject specifies a project to bill for access
     *   charges associated with the request.
     * @param string|array $defaultScope The default scope to use if no
     *   user-defined scopes exist, expressed either as an Array or as a
     *   space-delimited string.
     *
     * @return CredentialsLoader
     * @throws DomainException if no implementation can be obtained.
     */
    public static function getCredentials($scope = null, $httpHandler = null, $cacheConfig = null, $cache = null, $quotaProject = null, $defaultScope = null)
    {
        $creds = null;
        $jsonKey = CredentialsLoader::fromEnv() ?: CredentialsLoader::fromWellKnownFile();
        $anyScope = $scope ?: $defaultScope;
        if (!$httpHandler) {
            if (!$client = HttpClientCache::getHttpClient()) {
                $client = new Client();
                HttpClientCache::setHttpClient($client);
            }
            $httpHandler = HttpHandlerFactory::build($client);
        }
        if (!is_null($jsonKey)) {
            if ($quotaProject) {
                $jsonKey['quota_project_id'] = $quotaProject;
            }
            $creds = CredentialsLoader::makeCredentials($scope, $jsonKey, $defaultScope);
        } elseif (AppIdentityCredentials::onAppEngine() && !GCECredentials::onAppEngineFlexible()) {
            $creds = new AppIdentityCredentials($anyScope);
        } elseif (self::onGce($httpHandler, $cacheConfig, $cache)) {
            $creds = new GCECredentials(null, $anyScope, null, $quotaProject);
        }
        if (is_null($creds)) {
            throw new DomainException(self::notFound());
        }
        if (!is_null($cache)) {
            $creds = new FetchAuthTokenCache($creds, $cacheConfig, $cache);
        }
        return $creds;
    }
    /**
     * Obtains an AuthTokenMiddleware which will fetch an ID token to use in the
     * Authorization header. The middleware is configured with the default
     * FetchAuthTokenInterface implementation to use in this environment.
     *
     * If supplied, $targetAudience is used to set the "aud" on the resulting
     * ID token.
     *
     * @param string $targetAudience The audience for the ID token.
     * @param callable $httpHandler callback which delivers psr7 request
     * @param array $cacheConfig configuration for the cache when it's present
     * @param CacheItemPoolInterface $cache A cache implementation, may be
     *        provided if you have one already available for use.
     * @return AuthTokenMiddleware
     * @throws DomainException if no implementation can be obtained.
     */
    public static function getIdTokenMiddleware($targetAudience, $httpHandler = null, $cacheConfig = null, $cache = null)
    {
        $creds = self::getIdTokenCredentials($targetAudience, $httpHandler, $cacheConfig, $cache);
        return new AuthTokenMiddleware($creds, $httpHandler);
    }
    /**
     * Obtains an ProxyAuthTokenMiddleware which will fetch an ID token to use in the
     * Authorization header. The middleware is configured with the default
     * FetchAuthTokenInterface implementation to use in this environment.
     *
     * If supplied, $targetAudience is used to set the "aud" on the resulting
     * ID token.
     *
     * @param string $targetAudience The audience for the ID token.
     * @param callable $httpHandler callback which delivers psr7 request
     * @param array $cacheConfig configuration for the cache when it's present
     * @param CacheItemPoolInterface $cache A cache implementation, may be
     *        provided if you have one already available for use.
     * @return ProxyAuthTokenMiddleware
     * @throws DomainException if no implementation can be obtained.
     */
    public static function getProxyIdTokenMiddleware($targetAudience, $httpHandler = null, $cacheConfig = null, $cache = null)
    {
        $creds = self::getIdTokenCredentials($targetAudience, $httpHandler, $cacheConfig, $cache);
        return new ProxyAuthTokenMiddleware($creds, $httpHandler);
    }
    /**
     * Obtains the default FetchAuthTokenInterface implementation to use
     * in this environment, configured with a $targetAudience for fetching an ID
     * token.
     *
     * @param string $targetAudience The audience for the ID token.
     * @param callable $httpHandler callback which delivers psr7 request
     * @param array $cacheConfig configuration for the cache when it's present
     * @param CacheItemPoolInterface $cache A cache implementation, may be
     *        provided if you have one already available for use.
     * @return CredentialsLoader
     * @throws DomainException if no implementation can be obtained.
     * @throws InvalidArgumentException if JSON "type" key is invalid
     */
    public static function getIdTokenCredentials($targetAudience, $httpHandler = null, $cacheConfig = null, $cache = null)
    {
        $creds = null;
        $jsonKey = CredentialsLoader::fromEnv() ?: CredentialsLoader::fromWellKnownFile();
        if (!$httpHandler) {
            if (!$client = HttpClientCache::getHttpClient()) {
                $client = new Client();
                HttpClientCache::setHttpClient($client);
            }
            $httpHandler = HttpHandlerFactory::build($client);
        }
        if (!is_null($jsonKey)) {
            if (!array_key_exists('type', $jsonKey)) {
                throw new \InvalidArgumentException('json key is missing the type field');
            }
            if ($jsonKey['type'] == 'authorized_user') {
                throw new InvalidArgumentException('ID tokens are not supported for end user credentials');
            }
            if ($jsonKey['type'] != 'service_account') {
                throw new InvalidArgumentException('invalid value in the type field');
            }
            $creds = new ServiceAccountCredentials(null, $jsonKey, null, $targetAudience);
        } elseif (self::onGce($httpHandler, $cacheConfig, $cache)) {
            $creds = new GCECredentials(null, null, $targetAudience);
        }
        if (is_null($creds)) {
            throw new DomainException(self::notFound());
        }
        if (!is_null($cache)) {
            $creds = new FetchAuthTokenCache($creds, $cacheConfig, $cache);
        }
        return $creds;
    }
    private static function notFound()
    {
        $msg = 'Could not load the default credentials. Browse to ';
        $msg .= 'https://developers.google.com';
        $msg .= '/accounts/docs/application-default-credentials';
        $msg .= ' for more information';
        return $msg;
    }
    private static function onGce($httpHandler = null, $cacheConfig = null, $cache = null)
    {
        $gceCacheConfig = [];
        foreach (['lifetime', 'prefix'] as $key) {
            if (isset($cacheConfig['gce_' . $key])) {
                $gceCacheConfig[$key] = $cacheConfig['gce_' . $key];
            }
        }
        return (new GCECache($gceCacheConfig, $cache))->onGce($httpHandler);
    }
}

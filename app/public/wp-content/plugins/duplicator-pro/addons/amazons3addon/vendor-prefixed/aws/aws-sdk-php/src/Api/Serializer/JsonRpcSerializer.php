<?php

namespace VendorDuplicator\Aws\Api\Serializer;

use VendorDuplicator\Aws\Api\Service;
use VendorDuplicator\Aws\CommandInterface;
use VendorDuplicator\Aws\EndpointV2\EndpointProviderV2;
use VendorDuplicator\Aws\EndpointV2\EndpointV2SerializerTrait;
use VendorDuplicator\GuzzleHttp\Psr7\Request;
use VendorDuplicator\Psr\Http\Message\RequestInterface;
/**
 * Prepares a JSON-RPC request for transfer.
 * @internal
 */
class JsonRpcSerializer
{
    use EndpointV2SerializerTrait;
    /** @var JsonBody */
    private $jsonFormatter;
    /** @var string */
    private $endpoint;
    /** @var Service */
    private $api;
    /** @var string */
    private $contentType;
    /**
     * @param Service  $api           Service description
     * @param string   $endpoint      Endpoint to connect to
     * @param JsonBody $jsonFormatter Optional JSON formatter to use
     */
    public function __construct(Service $api, $endpoint, $jsonFormatter = null)
    {
        $this->endpoint = $endpoint;
        $this->api = $api;
        $this->jsonFormatter = $jsonFormatter ?: new JsonBody($this->api);
        $this->contentType = JsonBody::getContentType($api);
    }
    /**
     * When invoked with an AWS command, returns a serialization array
     * containing "method", "uri", "headers", and "body" key value pairs.
     *
     * @param CommandInterface $command Command to serialize into a request.
     * @param $endpointProvider Provider used for dynamic endpoint resolution.
     * @param $clientArgs Client arguments used for dynamic endpoint resolution.
     *
     * @return RequestInterface
     */
    public function __invoke(CommandInterface $command, $endpointProvider = null, $clientArgs = null)
    {
        $operationName = $command->getName();
        $operation = $this->api->getOperation($operationName);
        $commandArgs = $command->toArray();
        $headers = ['X-Amz-Target' => $this->api->getMetadata('targetPrefix') . '.' . $operationName, 'Content-Type' => $this->contentType];
        if ($endpointProvider instanceof EndpointProviderV2) {
            $this->setRequestOptions($endpointProvider, $command, $operation, $commandArgs, $clientArgs, $headers);
        }
        return new Request($operation['http']['method'], $this->endpoint, $headers, $this->jsonFormatter->build($operation->getInput(), $commandArgs));
    }
}

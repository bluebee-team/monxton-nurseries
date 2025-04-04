<?php

namespace VendorDuplicator\Aws\Api\ErrorParser;

use VendorDuplicator\Aws\Api\Parser\JsonParser;
use VendorDuplicator\Aws\Api\Service;
use VendorDuplicator\Aws\Api\StructureShape;
use VendorDuplicator\Aws\CommandInterface;
use VendorDuplicator\Psr\Http\Message\ResponseInterface;
/**
 * Parses JSON-REST errors.
 */
class RestJsonErrorParser extends AbstractErrorParser
{
    use JsonParserTrait;
    private $parser;
    public function __construct($api = null, $parser = null)
    {
        parent::__construct($api);
        $this->parser = $parser ?: new JsonParser();
    }
    public function __invoke(ResponseInterface $response, $command = null)
    {
        $data = $this->genericHandler($response);
        // Merge in error data from the JSON body
        if ($json = $data['parsed']) {
            $data = array_replace($data, $json);
        }
        // Correct error type from services like Amazon Glacier
        if (!empty($data['type'])) {
            $data['type'] = strtolower($data['type']);
        }
        // Retrieve the error code from services like Amazon Elastic Transcoder
        if ($code = $response->getHeaderLine('x-amzn-errortype')) {
            $colon = strpos($code, ':');
            $data['code'] = $colon ? substr($code, 0, $colon) : $code;
        }
        // Retrieve error message directly
        $data['message'] = isset($data['parsed']['message']) ? $data['parsed']['message'] : (isset($data['parsed']['Message']) ? $data['parsed']['Message'] : null);
        $this->populateShape($data, $response, $command);
        return $data;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: aether-framework
 * Date: 08/01/16
 * Time: 17:59
 */

namespace AEtherFramework\Http\Client\Adapter;


use AEtherFramework\Http\Exception;
use AEtherFramework\Http\ClientInterface;
use AEtherFramework\Http\Request;
use AEtherFramework\Http\RequestInterface;
use AEtherFramework\Http\Response;

class Stream implements ClientInterface
{
    protected $timeout = 300;

    /**
     * @param RequestInterface $request
     * @return Response
     * @throws Exception\RequestTimeout
     * @throws Exception\UnableToConnectToServer
     * @throws Exception\UnknownHTTPResponseCode
     */
    public function send(RequestInterface $request)
    {
        $headers = '';
        foreach($request->getHeaders() as $headerKey=>$header) {
            $headers .= "{$headerKey}: {$header}\r\n";
        }

        $startTime = time();
        $responseContents = file_get_contents(
            $request->getFullyQualifiedUri(),
            false,
            stream_context_create([
                'http' => [
                    'timeout' => $this->timeout,
                    'method'        => $request->getVerb(),
                    'header'        => $headers,
                    'content'       => $request->getBody(),
                    'ignore_errors' => true,
                ]
            ])
        );
        $endTime = time();
        if (!isset($http_response_header) || !$http_response_header) {
            if($endTime - $startTime > $this->timeout) {
                throw new Exception\RequestTimeout("Request timeout expired after $this->timeout seconds");
            }
            throw new Exception\UnableToConnectToServer("Http response headers are not set, could not connect to server");
        }

        $response = (new Response)
            ->setBody($responseContents);

        foreach($http_response_header as $responseHeader) {
            $headerParts = explode(':', $responseHeader, 2);
            if (isset($headerParts[1])) {
                $response->addHeader(trim($headerParts[0]), trim($headerParts[1]));
            } else {
                $arr_parsed_headers['Response-Code'] = $responseHeader;
                if (preg_match("(HTTP/[0-9\.]+\s+([0-9]+))", $responseHeader, $matches)) {
                    $response->setCode($matches[1]);
                }
            }
        }
        return $response;

    }

    /**
     * Generates a new request object for use with this client
     * @return RequestInterface
     */
    public function getRequest()
    {
        return new Request();
    }

    /**
     * Set request timeout in seconds
     * @param int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }


}
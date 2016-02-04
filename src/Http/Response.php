<?php
namespace AetherFramework\Http;

use Http\Exception\UnknownHTTPResponseCode;

class Response implements ResponseInterface
{
    protected $body;
    protected $code;
    protected $headers = [];

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Response
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return isset($this->code) ? $this->code : 200;
    }

    /**
     * @param int $code
     * @throws UnknownHTTPResponseCode
     * @return Response
     */
    public function setCode($code)
    {
        if(!isset(ResponseCodes::$responseCodes[$code])) {
            throw new UnknownHTTPResponseCode(sprintf('Response code %s is not recognised', $code));
        }
        $this->code = $code;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $header
     * @param string $contents
     * @return Response
     */
    public function addHeader($header, $contents)
    {
        $this->headers[$header] = $contents;
        return $this;
    }

    /**
     * @param string $header
     * @return Response
     */
    public function getHeader($header)
    {
        return $this->headers[$header];
    }
}



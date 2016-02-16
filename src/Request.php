<?php
/**
 * Created by PhpStorm.
 * User: aether-framework
 * Date: 13/01/16
 * Time: 18:16
 */

namespace AetherFramework\Http;


class Request implements RequestInterface
{
    protected $queryParameters;
    protected $body;
    protected $headers;
    protected $requestPath;
    protected $path;
    protected $host;
    protected $protocol;
    protected $verb;
    protected $isHttps;

    /**
     * Returns the query parameters as a key value pair array
     * @return array
     */
    public function getQuery()
    {
        return $this->queryParameters;
    }

    /**
     * Returns the body of the request as a key value pair array
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Returns the request headers as a key value pair array
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Returns the query parameter denoted by the supplied key
     *
     * Default value is returned if key is not present
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getQueryValue($key, $default = null)
    {
        return isset($this->queryParameters[$key]) ? $this->queryParameters[$key] : $default;
    }

    /**
     * @param string $key
     * @param $value
     * @return RequestInterface
     */
    public function addQueryValue($key, $value)
    {
        $this->queryParameters[$key] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getBodyValue($key, $default = null)
    {
        return isset($this->body[$key]) ? $this->body[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getHeaderValue($key, $default = null)
    {
        return isset($this->headers[$key]) ? $this->headers[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Request
     */
    public function addHeaderValue($key, $value)
    {
         $this->headers[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return RequestInterface
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return string
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * @param string $verb
     * @return string
     */
    public function setVerb($verb)
    {
        $this->verb = $verb;
        return $this;
    }

    /**
     * @param $isHttps
     * @return $this
     */
    public function setHttps($isHttps) {
        $this->isHttps = $isHttps;
        return $this;
    }
    public function isHttps()
    {
        // TODO: Implement isHttps() method.
    }

    public function getFullyQualifiedUri()
    {
        // TODO: Implement getFullyQualifiedUri() method.
    }

}


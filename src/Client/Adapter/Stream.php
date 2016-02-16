<?php
/**
 * Created by PhpStorm.
 * User: aether-framework
 * Date: 08/01/16
 * Time: 17:59
 */

namespace AetherFramework\Http\Client\Adapter;


use AetherFramework\Http\ClientInterface;
use AetherFramework\Http\Request;
use AetherFramework\Http\RequestInterface;
use AetherFramework\Http\ResponseInterface;

class Stream implements ClientInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request)
    {

    }

    /**
     * Generates a new request object for use with th
     * is client
     * @return RequestInterface
     */
    public function getRequest()
    {
        return new Request();
    }

}
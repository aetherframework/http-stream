<?php
/**
 * Created by PhpStorm.
 * User: delphicokami
 * Date: 26/02/16
 * Time: 18:40
 */

namespace AEtherFramework\Http\Exception;


class UnknownHTTPResponseCode extends \Exception
{
    public function __construct($message = "", $code = 500, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace Tivins\Baz\API\Exceptions;

use Exception;
use Tivins\Baz\Core\Net\http\Status;

abstract class APIException extends Exception
{
    abstract public function getStatus(): Status;
}
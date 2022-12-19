<?php

namespace Tivins\baz\api\exceptions;

use Exception;
use Tivins\baz\core\net\http\Status;

abstract class APIException extends Exception
{
    abstract public function getStatus(): Status;
}
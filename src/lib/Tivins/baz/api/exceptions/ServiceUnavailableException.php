<?php

namespace Tivins\baz\api\exceptions;

use Tivins\baz\core\net\http\Status;

class ServiceUnavailableException extends APIException
{
    public function getStatus(): Status
    {
        return Status::ServiceUnavailable;
    }
}
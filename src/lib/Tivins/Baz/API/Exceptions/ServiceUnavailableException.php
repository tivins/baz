<?php

namespace Tivins\Baz\API\Exceptions;

use Tivins\Baz\Core\Net\http\Status;

class ServiceUnavailableException extends APIException
{
    public function getStatus(): Status
    {
        return Status::ServiceUnavailable;
    }
}
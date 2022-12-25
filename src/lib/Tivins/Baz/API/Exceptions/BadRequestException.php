<?php

namespace Tivins\Baz\API\Exceptions;

use Tivins\Baz\Core\Net\http\Status;

class BadRequestException extends APIException
{
    public function getStatus(): Status
    {
        return Status::BadRequest;
    }
}
<?php

namespace Tivins\Baz\API\Exceptions;

use Tivins\Baz\Core\Net\http\Status;

class AuthorizationException extends APIException
{
    public function getStatus(): Status
    {
        return Status::Unauthorized;
    }
}
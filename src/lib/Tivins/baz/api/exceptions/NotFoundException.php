<?php

namespace Tivins\baz\api\exceptions;

use Tivins\baz\core\net\http\Status;

class NotFoundException extends APIException
{
    public function getStatus(): Status
    {
        return Status::NotFound;
    }
}
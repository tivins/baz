<?php

namespace Tivins\baz\api;

use Attribute;
use Tivins\baz\core\net\http\Method;

#[Attribute(Attribute::TARGET_METHOD|Attribute::TARGET_CLASS)]
class APIAccess
{
    public function __construct(
        public string $service,
        public Method $method,
        public string $permission = 'public')
    {
    }
}
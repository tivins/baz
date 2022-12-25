<?php

namespace Tivins\Baz\API;

use Attribute;
use Tivins\Baz\Core\Net\Http\Method;

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
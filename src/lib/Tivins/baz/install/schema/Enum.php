<?php

namespace Tivins\baz\install\schema;

use tivins\baz\api\APIAccess;

readonly class Enum
{
    public function __construct(
        public string $name = '',
        public string $type = 'int',
        public string $comment = '',
        public array $cases = [],
        public APIAccess|null $access = null,
    ) {
    }
}

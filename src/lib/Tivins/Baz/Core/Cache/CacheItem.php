<?php

namespace Tivins\Baz\Core\Cache;

readonly class CacheItem
{
    public function __construct(
        public string $data,
        public mixed  $meta = null,
    )
    {
    }
}
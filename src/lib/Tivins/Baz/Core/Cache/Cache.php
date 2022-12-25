<?php

namespace Tivins\Baz\Core\Cache;

abstract class Cache
{
    public const None      = 0;
    public const Unlimited = -1;

    abstract public function set(string $key, CacheItem $item): bool;

    abstract public function get(string $key, int $lifeTime = self::Unlimited): ?CacheItem;

    abstract public function delete(string $key): void;

    abstract public function exists(string $key): bool;

    abstract public function getAge(string $key): int;

}


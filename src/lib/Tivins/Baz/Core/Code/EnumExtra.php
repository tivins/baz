<?php

namespace Tivins\Baz\Core\Code;

use ReflectionEnum;
use Tivins\Baz\Core\Intl\Intl;

/**
 * @see \Tivins\Core\Code\EnumExtra
 */
trait EnumExtra
{
    public function translate(): string
    {
        $intl_key = strtolower(str_replace('\\', '_', static::class)) . '_' . $this->name;
        return Intl::get($intl_key);
    }
}
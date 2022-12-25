<?php

namespace Tivins\Baz\Core\Code;

use Tivins\Baz\Core\Util;

trait FastToString
{
    public function __toString(): string
    {
        return static::class.'#'.Util::getObjectID($this);
    }
}
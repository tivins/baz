<?php

namespace Tivins\baz\core;

use PHPUnit\Framework\TestCase;

class IntlTest extends TestCase {

    public function testFormat()
    {
        Intl::setData(['test' => 'Hello %d world']);
        self::assertEquals('Hello the world', Intl::format('test', ['%d'=>'the']));
    }
}

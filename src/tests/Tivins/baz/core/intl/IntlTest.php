<?php

namespace Tivins\baz\core\intl;

use PHPUnit\Framework\TestCase;

class IntlTest extends TestCase {

    public function testGet()
    {
        Intl::setData(['hello' => 'Hello world']);
        self::assertEquals('Hello world', Intl::get('hello'));
    }
    public function testFormat()
    {
        Intl::setData(['test' => 'Hello %d world']);
        self::assertEquals('Hello the world', Intl::format('test', ['%d'=>'the']));
    }
}

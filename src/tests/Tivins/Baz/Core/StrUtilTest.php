<?php

namespace Tivins\Baz\Core;

use PHPUnit\Framework\TestCase;

class StrUtilTest extends TestCase {

    public function testSnakeToCamel()
    {
        self::assertEquals("thisIsASnakeString", StrUtil::snakeToCamel("this_is_a_snake_string"));
        self::assertEquals("ThisIsASnakeString", StrUtil::snakeToCamel("this_is_a_snake_string", false));
    }
}

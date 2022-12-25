<?php

namespace Tivins\Baz\Core\Net\Http;

use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase {

    public function testIsError()
    {
        self::assertTrue(Status::NotFound->isError());
        self::assertFalse(Status::OK->isError());
    }
}

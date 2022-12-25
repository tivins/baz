<?php

namespace Tivins\Baz\Core\Intl;

use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase {

    public function testGetNatural()
    {
        self::assertEquals("Français", Language::French->getNatural());
    }
}

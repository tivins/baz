<?php

namespace Tivins\baz\core\intl;

use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase {

    public function testGetNatural()
    {
        self::assertEquals("Français", Language::French->getNatural());
    }
}

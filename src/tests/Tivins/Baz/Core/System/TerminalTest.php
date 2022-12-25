<?php

namespace Tivins\Baz\Core\System;

use PHPUnit\Framework\TestCase;
use Tivins\Baz\Core\Color;

class TerminalTest extends TestCase {

    public function _testDecorateRGB()
    {
        Terminal::decorateRGB(
            foreColor: new Color(0x00, 0x66, 0x99),
            backColor: new Color(0xff, 0xff, 0x00)
        );
        echo "Foo";
        Terminal::decorateReset();
    }
}

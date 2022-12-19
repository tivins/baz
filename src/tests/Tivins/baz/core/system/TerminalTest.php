<?php

namespace Tivins\baz\core\system;

use PHPUnit\Framework\TestCase;
use Tivins\baz\core\Color;

class TerminalTest extends TestCase {

    public function testDecorateRGB()
    {
        Terminal::decorateRGB(
            foreColor: new Color(0x00, 0x66, 0x99),
            backColor: new Color(0xff, 0xff, 0x00)
        );
        echo "Foo";
        Terminal::decorateReset();
    }
}

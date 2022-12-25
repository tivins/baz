<?php

namespace Tivins\Baz\Core;

class Color {
    public function __construct(
        public int $red,
        public int $green,
        public int $blue,
    )
    {
    }
}
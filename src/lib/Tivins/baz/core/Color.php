<?php

namespace Tivins\baz\core;

class Color {
    public function __construct(
        public int $red,
        public int $green,
        public int $blue,
    )
    {
    }
}
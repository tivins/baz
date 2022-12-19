<?php

namespace Tivins\baz\app;

class App
{
    private static int $timeStart = 0;

    public function start(): void
    {
        self::$timeStart = microtime(true);
    }

    public static function getTimeStart(): int
    {
        return self::$timeStart;
    }

}
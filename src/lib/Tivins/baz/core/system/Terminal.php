<?php

namespace Tivins\baz\core\system;

class Terminal
{
    // also: chr(27) or "\033"
    public const ESCAPE_CHAR = "\e";

    public static function savePosition(): void
    {
        echo self::ESCAPE_CHAR . '[s';
    }

    public static function restorePosition(): void
    {
        echo self::ESCAPE_CHAR . '[u';
    }

    public static function clearLine(): void
    {
        echo "\r" . self::ESCAPE_CHAR . '[K';
    }

    public static function goUp(int $nbLines): void
    {
        echo self::ESCAPE_CHAR . '[' . $nbLines . 'A';
    }

    public static function goUpClean(int $nbLines): void
    {
        while ($nbLines--) {
            static::goUp(1);
            static::clearLine();
        }
    }

    public static function goDown(int $nbLines): void
    {
        echo self::ESCAPE_CHAR . '[' . $nbLines . 'B';
    }
}
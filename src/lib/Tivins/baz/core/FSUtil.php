<?php

namespace Tivins\baz\core;

class FSUtil
{
    public static function mkdir(string $dir): bool
    {
        if (is_dir($dir)) {
            return true;
        }
        return mkdir($dir, 0755, true);
    }

    public static function mkdirFile(string $file): bool
    {
        return self::mkdir(dirname($file));
    }

    public static function unlink($file): void
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    /**
     * @todo Allow to historize?
     */
    public static function loadFile(string $file): string|bool
    {
        return file_get_contents($file);
    }

    public static function loadJSONFile(string $file): mixed
    {
        $content = self::loadFile($file);
        if ($content === false) {
            return null;
        }
        return json_decode($content);
    }

    /**
     * Save `$content` into the file located at `$filePath`.
     * @return bool True if the file was saved, false if an error occurs.
     * @todo Allow to historize?
     */
    public static function saveFile(string $filePath, string $content): bool
    {
        self::mkdirFile($filePath);
        return file_put_contents($filePath, $content) !== false;
    }
}
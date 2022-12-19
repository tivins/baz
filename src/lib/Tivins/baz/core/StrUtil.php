<?php

namespace Tivins\baz\core;

class StrUtil {

    public static function html(?string $str): string
    {
        return htmlentities($str ?? '', ENT_QUOTES, 'utf-8');
    }

    public static function snakeToCamel(string $key, $lower = true): string
    {
        $key = ucwords(str_replace('_', ' ', $key));
        $upper = str_replace(' ', '', $key);
        return $lower ? ucfirst($upper) : $upper;
    }

    public static function slug(string $get_name): string
    {
        return trim(str_replace(mb_str_split(' !\'"{}[]()<>_@'), '-', mb_strtolower($get_name)), '-');
    }

    public static function getExtension(string $file): string
    {
        return mb_strtolower(mb_substr($file, strrpos($file, '.') + 1));
    }
}
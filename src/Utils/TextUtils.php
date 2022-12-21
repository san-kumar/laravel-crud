<?php

namespace San\Crud\Utils;

use Illuminate\Support\Str;

class TextUtils {
    public static function replaceBlanks(string $text, array $replacements = []) {
        foreach ($replacements as $key => $value) {
            $k = "_{$key}_";
            $text = str_replace("/*\$$k*/", "\$$value", $text);
            $text = str_replace("/*$k*/", $value, $text);
            $text = str_replace($k, $value, $text);
        }

        return preg_replace('/(\s*\n){2,}/', "\n\n", $text);
    }

    public static function arrayExport($arr) {
        return sprintf('[%s]', implode(', ', array_map(fn($v) => is_string($v) ? sprintf('"%s" => "%s"', $v, Str::title($v)) : $v, $arr)));
    }
}

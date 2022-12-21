<?php

namespace San\Crud\Utils;

class FileUtils {

    public static function getFiles(string $path, array $filter = []) {
        if (!is_dir($path)) return [];

        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

        /** @var \SplFileInfo $file */
        foreach ($iterator as $file) {
            if (!$file->isFile()) continue;
            if (count($filter) > 0 && !in_array($file->getExtension(), $filter)) continue;

            $files[] = $file->getRealPath();
        }

        return $files ?? [];
    }

    public static function recursiveCopy($src, $dest, $force = FALSE) {
        $files = self::getFiles($src);
        $count = 0;

        foreach ($files as $file) {
            $target = $dest . DIRECTORY_SEPARATOR . str_replace($src, '', $file);

            if (file_exists($target) && !$force) {
                continue;
            } else {
                $dir = dirname($target);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, TRUE);
                }

                copy($file, $target);
                $count++;
            }
        }

        return $count;
    }

    public static function writeFile(string $dest, string $str) {
        $dir = dirname($dest);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, TRUE);
        }

        return file_put_contents($dest, $str);
    }
}

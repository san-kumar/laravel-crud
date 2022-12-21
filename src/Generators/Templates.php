<?php

namespace San\Crud\Generators;

use San\Crud\Utils\FileUtils;
use San\Crud\Utils\TextUtils;

class Templates {
    public function __construct(public string $path) {
        if (!is_dir($path)) {
            throw new \Exception("Templates path not found: $path");
        }
    }

    public function getStubs(string $suffix) {
        $files = FileUtils::getFiles("$this->path/stubs/$suffix", ['php']);
        return array_values(array_filter($files, fn($file) => !\str_contains($file, 'partials')));
    }

    public function getFirstStub(string $suffix) {
        $stubs = $this->getStubs($suffix);
        return $stubs[0] ?? NULL;
    }

    public function getDest(string $type, mixed $stub, array $replacements = [], string $suffix = '') {
        $dest = \str_contains($type, 'views/') ? resource_path('views') . "/$suffix" : ($type === 'routes'  ? base_path("routes/crud") : ($type === 'Controllers' ? app_path('Http/Controllers') : app_path($type)));
        $str = sprintf('%s/%s', $dest, basename($stub));
        return TextUtils::replaceBlanks($str, $replacements);
    }

    public function templatePath() {
        return $this->path;
    }
}

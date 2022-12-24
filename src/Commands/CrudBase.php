<?php

namespace San\Crud\Commands;

use Illuminate\Console\Command;

class CrudBase extends Command {
    protected function getConfig($path = NULL, $default = NULL) {
        $config = config('crud') ?: [];

        return !empty($path) ? (data_get($config, $path) ?: $default) : $config;
    }

    protected function getStubTypes($css) {
        return ['Controllers', 'Models', 'Policies', 'routes', "views/$css"];
    }

    protected function getTemplateDir() {
        $customDir = $this->getConfig('template-dir');

        if (!empty($customDir)) {
            if (!is_dir($customDir)) {
                $this->error("Template directory '$customDir' does not exist");
                exit(1);
            }

            return $customDir;
        }

        return $this->getConfig('template_dir', __DIR__ . '/../template');
    }

    protected function getCssFramework() {
        if ($this->option('css') === 'tailwind') return 'tailwind';
        if ($this->option('tailwind')) return 'tailwind';

        return $this->getConfig('css', 'bootstrap');
    }

    protected function getTables() {
        return array_values(array_filter(array_map('trim', preg_split('/\.\s*/', $this->argument('table')))));
    }
}
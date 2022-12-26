<?php

namespace San\Crud\Commands;

use Illuminate\Console\Command;
use San\Crud\Utils\SchemaUtils;

class CrudBase extends Command {
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

    protected function getConfig($path = NULL, $default = NULL) {
        $config = config('crud') ?: [];

        return !empty($path) ? (data_get($config, $path) ?: $default) : $config;
    }

    protected function getCssFramework() {
        if ($this->option('css') === 'tailwind') return 'tailwind';
        if ($this->option('tailwind')) return 'tailwind';

        return $this->getConfig('css', 'bootstrap');
    }

    protected function getTables($checkExists = TRUE) {
        $tables = array_values(array_filter(array_map('trim', preg_split('/\.\s*/', $this->argument('table')))));
        $aliases = $this->getTableAliases();

        if ($checkExists) {
            foreach ($tables as $table) {
                if (!SchemaUtils::tableExists($aliases[$table] ?? $table)) {
                    $this->warn("Table $table does not exist in the database. Did you forget to run migrations?");
                }
            }
        }

        return $tables;
    }

    protected function getTableAliases() {
        if (!$this->hasOption('alias')) return [];

        $aliases = $this->option('alias');

        foreach ($aliases as $alias) {
            [$a, $t] = explode('=', $alias);
            if (!empty($a) && !empty($t)) {
                if (SchemaUtils::tableExists($t)) {
                    $results[$a] = $t;
                } else {
                    $this->warn("Table $t (alias $a) does not exist in the database. Did you forget to run migrations?");
                }
            }
        }

        return $results ?? [];
    }
}
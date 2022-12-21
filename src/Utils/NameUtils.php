<?php

namespace San\Crud\Utils;

use Illuminate\Support\Str;

class NameUtils {
    public static function titleCase(string $name) {
        return Str::title(str_replace('_', ' ', $name));
    }

    public static function studlyCase(string|array $tables) {
        return join('', array_map(fn($tableName) => Str::studly(Str::singular($tableName)), (array) $tables));
    }

    public static function getModelName(string|array $tables) {
        return self::studlyCase((array) $tables);
    }

    public static function getControllerName(string|array $tables) {
        return self::studlyCase((array) $tables) . 'Controller';
    }

    public static function getRouteName(string|array $tables) {
        return join('.', array_map(fn($tableName) => Str::kebab(Str::plural($tableName)), (array) $tables));
    }

    public static function getVariableName(string $table) {
        return Str::singular(self::getVariableNamePlural($table));
    }

    public static function getVariableNamePlural(string $table) {
        return Str::camel($table);
    }

    public static function getPolicyName(string|array $tables) {
        return self::studlyCase((array) $tables) . 'Policy';
    }
}

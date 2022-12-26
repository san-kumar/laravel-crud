<?php

namespace San\Crud\Utils;

use Illuminate\Support\Facades\DB;

class SchemaUtils {
    public static function getTables(string|array $exclude, bool $withViews = TRUE) {
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        if ($withViews) {
            $views = DB::connection()->getDoctrineSchemaManager()->listViews();
            $tables = array_merge($tables, array_keys($views));
        }

        return array_values(array_filter($tables, fn($table) => !in_array($table, (array) $exclude)));
    }

    public static function getTableFields(string $tableName, array $excludedColumns = [], array $alwaysIgnoredColumns = ['id', 'created_at', 'updated_at', 'deleted_at']) {
        // ugly enum hack as doctrine does not support enum types
        // https://www.doctrine-project.org/projects/doctrine-orm/en/latest/cookbook/mysql-enums.html#solution-1-mapping-to-varchars

        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'guid');

        $columns = DB::getDoctrineSchemaManager()->listTableColumns($tableName);
        $ignoredColumns = array_merge((array) $excludedColumns, (array) $alwaysIgnoredColumns);
        $indexes = DB::getDoctrineSchemaManager()->listTableIndexes($tableName);
        $uniqueColumns = [];

        foreach ($indexes as $index) {
            if ($index->isUnique() && count($index->getColumns()) === 1) {
                $uniqueColumns = array_merge($uniqueColumns, $index->getColumns());
            }
        }

        foreach ($columns as $column) {
            if (in_array($column->getName(), $ignoredColumns)) continue;

            $field = ['id' => $column->getName(), 'type' => $column->getType()->getName(), 'name' => \Str::title(str_replace('_', ' ', $column->getName())), 'nullable' => !$column->getNotnull()];

            if ($field['type'] == 'guid') {
                try {
                    $enums = DB::select("SHOW COLUMNS FROM $tableName WHERE Field = '$field[id]'");
                    $field['values'] = explode(',', str_replace("'", '', substr($enums[0]->Type, 5, -1)));
                } catch (\Throwable $e) {
                    echo '';
                }
            }

            if (preg_match('/^(.*?)_id$/', $field['id'], $matches)) {
                $relatedTable = \Str::plural($matches[1]);
                if (self::tableExists($relatedTable)) {
                    $field['relation'] = $matches[1];
                    $field['related_table'] = $relatedTable;
                }
            }

            //check if column is unique index
            if (in_array($field['id'], $uniqueColumns)) {
                $field['unique'] = TRUE;
            }

            $fields[] = $field;
        }

        return $fields ?? [];
    }

    public static function firstHumanReadableField(string $table, string $key = NULL) {
        $all = self::getTableFields($table);
        if (empty($all)) return NULL;

        foreach ($all as $f) {
            if (preg_match('/_id$/', $f['id'])) continue;
            if (preg_match('/(string|text)/', $f['type'])) return $key ? $f[$key] : $f;
            $last = $f['id'];
        }

        $result = $last ?? $all[0];
        return $key ? $result[$key] : $result;
    }

    public static function getTableFieldsWithIds(string $table, array $excludedColumns = []) {
        return array_values(array_filter(self::getTableFields($table, $excludedColumns), fn($f) => !empty($f['relation'])));
    }

    public static function getUserIdField(string $tableName, $userIdField = 'user_id') {
        if (!self::tableExists($tableName)) return NULL;
        return \Schema::hasColumn($tableName, $userIdField) ? $userIdField : NULL;
    }

    public static function hasTable(string $tableName) {
        return self::tableExists($tableName);
    }

    public static function hasTimestamps(string $tableName) {
        if (!self::tableExists($tableName)) return FALSE;
        return \Schema::hasColumn($tableName, 'created_at') && \Schema::hasColumn($tableName, 'updated_at');
    }

    public static function hasSoftDelete(string $tableName) {
        if (!self::tableExists($tableName)) return FALSE;
        return \Schema::hasColumn($tableName, 'deleted_at');
    }

    public static function tableExists(string $tableName) {
        return \Schema::hasTable($tableName);
    }
}

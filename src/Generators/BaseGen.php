<?php

namespace San\Crud\Generators;

use Illuminate\Support\Str;
use San\Crud\Utils\NameUtils;
use San\Crud\Utils\SchemaUtils;

class BaseGen {
    public function __construct(public array $tables, public array $aliases = []) { }

    public function getVarName() {
        return Str::singular($this->getVarNamePlural());
    }

    public function getVarNamePlural() {
        return NameUtils::getVariableNamePlural($this->mainTable());
    }

    public function mainTable() {
        return $this->tables[count($this->tables) - 1];
    }

    public function getTitle() {
        return Str::singular($this->getTitlePlural());
    }

    public function getTitlePlural() {
        return NameUtils::titleCase($this->mainTable());
    }

    public function getParentVarName() {
        return Str::singular($this->getParentVarNamePlural());
    }

    public function getParentVarNamePlural() {
        return NameUtils::getVariableNamePlural($this->parentTable());
    }

    public function parentTable() {
        return $this->tables[count($this->tables) - 2];
    }

    public function getMainModelName() {
        return NameUtils::getModelName((array) $this->mainTable());
    }

    public function getMainVarName() {
        return NameUtils::getVariableName($this->mainTable());
    }

    public function hasParentTable() {
        return count($this->tables) > 1;
    }

    public function parentTables() {
        return array_slice($this->tables, 0, -1);
    }

    public function getVars(array $tables, array $extraVars = []) {
        $vars = $this->getRawVars($tables, $extraVars);

        return !empty($vars) ? sprintf("compact(%s)", join(', ', array_map(fn($var) => sprintf("'%s'", $var), $vars))) : '[]';
    }

    public function getRawVars(array $tables, ?array $extraVars = []) {
        foreach ($tables as $table) {
            $vars[] = NameUtils::getVariableName($table);
        }

        return array_merge($vars ?? [], (array) $extraVars);
    }

    protected function hasUserId() {
        return SchemaUtils::getUserIdField($this->mainTableReal());
    }

    public function mainTableReal() {
        return $this->getTableNameFromAlias($this->mainTable());
    }

    public function getTableNameFromAlias($tableName) {
        return $this->aliases[$tableName] ?? $tableName;
    }

    public function getAliasFromTableName($tableName) {
        return array_search($tableName, $this->aliases) ?: $tableName;
    }

    protected function hasTimestamps() {
        return SchemaUtils::hasTimestamps($this->mainTableReal());
    }

    protected function hasSoftDeletes() {
        return SchemaUtils::hasSoftDelete($this->mainTableReal());
    }

    protected function getFirstReadableField($key = NULL) {
        return SchemaUtils::firstHumanReadableField($this->mainTableReal(), $key) ?: 'id';
    }

    protected function getFillableFields($exceptColumns = ['user_id']) {
        foreach (SchemaUtils::getTableFields($this->mainTableReal(), $exceptColumns) as $field) {
            if (in_array($field['related_table'] ?? '', $this->realTables())) continue;
            $fillable[] = $field;
        }

        return $fillable ?? [];
    }

    public function realTables() {
        return array_map(fn($table) => $this->getTableNameFromAlias($table), $this->tables);
    }

    protected function getExternallyRelatedFields() {
        $fields = SchemaUtils::getTableFieldsWithIds($this->mainTableReal(), ['user_id']);

        foreach ($fields as $field) {
            if (in_array($field['related_table'], $this->realTables())) continue;
            $externallyRelatedFields[] = $field;
        }

        return $externallyRelatedFields ?? [];
    }
}

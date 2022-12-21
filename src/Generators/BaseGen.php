<?php

namespace San\Crud\Generators;

use Illuminate\Support\Str;
use San\Crud\Utils\NameUtils;
use San\Crud\Utils\SchemaUtils;

class BaseGen {
    public function __construct(public array $tables) { }

    public function getVarName() {
        return Str::singular($this->getVarNamePlural());
    }

    public function getVarNamePlural() {
        return NameUtils::getVariableNamePlural($this->mainTable());
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

    public function hasParentTable() {
        return count($this->tables) > 1;
    }

    public function parentTables() {
        return array_slice($this->tables, 0, -1);
    }

    public function mainTable() {
        return $this->tables[count($this->tables) - 1];
    }

    public function parentTable() {
        return $this->tables[count($this->tables) - 2];
    }

    public function getVars(array $tables, array $extraVars = []) {
        foreach ($tables as $table) {
            $vars[] = NameUtils::getVariableName($table);
        }

        return !empty($vars) || !empty($extraVars) ? sprintf("compact(%s)", join(', ', array_map(fn($var) => sprintf("'%s'", $var), array_merge($vars ?? [], $extraVars)))) : '[]';
    }

    protected function hasUserId() {
        return SchemaUtils::getUserIdField($this->mainTable());
    }

    protected function hasTimestamps() {
        return SchemaUtils::hasTimestamps($this->mainTable());
    }

    protected function hasSoftDeletes() {
        return SchemaUtils::hasSoftDelete($this->mainTable());
    }

    protected function getFirstReadableField($key = NULL) {
        return SchemaUtils::firstHumanReadableField($this->mainTable(), $key) ?: 'id';
    }

    protected function getFillableFields($exceptColumns = ['user_id']) {
        foreach (SchemaUtils::getTableFields($this->mainTable(), $exceptColumns) as $field) {
            if (in_array($field['related_table'] ?? '', $this->tables)) continue;
            $fillable[] = $field;
        }

        return $fillable ?? [];
    }

    protected function getExternallyRelatedFields() {
        $fields = SchemaUtils::getTableFieldsWithIds($this->mainTable(), ['user_id']);

        foreach ($fields as $field) {
            if (in_array($field['related_table'], $this->tables)) continue;
            $externallyRelatedFields[] = $field;
        }

        return $externallyRelatedFields ?? [];
    }
}

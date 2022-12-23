<?php

namespace San\Crud\Generators;

use San\Crud\Utils\NameUtils;
use San\Crud\Utils\SchemaUtils;

class ControllerGen extends BaseGen {

    public function getControllerName() {
        return NameUtils::getControllerName($this->tables);
    }

    public function getControllerAllArgs() {
        return $this->getControllerArgs($this->tables);
    }

    public function getControllerParentArgs() {
        return $this->getControllerArgs($this->parentTables());
    }

    public function getControllerArgs(array $tables) {
        $value = join(', ', array_map(fn($table) => sprintf('%s $%s', NameUtils::getModelName((array) $table), NameUtils::getVariableName($table)), $tables));
        return !empty($value) ? "$value," : "";
    }

    public function getFindById() {
        return sprintf('$%s = %s::withTrashed()%s->find($%s_id);', $this->getVarName(), NameUtils::getModelName($this->mainTable()),
            $this->hasUserId() ? "->where('user_id', auth()->id())" : "", NameUtils::getVariableName($this->mainTable()));
    }

    public function getQuery() {
        if ($this->hasParentTable()) {
            $code[] = sprintf('$%s = $%s->%s();', $this->getVarNamePlural(), $this->getParentVarName(), $this->mainTable());
        } else {
            $code[] = sprintf('$%s = %s::query();', $this->getVarNamePlural(), NameUtils::getModelName((array) $this->mainTable()));
        }

        foreach (array_slice($this->tables, -2) as $table) {
            if (SchemaUtils::getUserIdField($table)) {
                $code[] = sprintf("\t\t\$%s->where('%s', auth()->id());", $table === $this->mainTable() ? NameUtils::getVariableNamePlural($table) : NameUtils::getVariableName($table), SchemaUtils::getUserIdField($table));
            }
        }

        if ($this->hasSoftDeletes()) {
            $code[] = sprintf("\n\t\tif (!!\$request->trashed) {\n\t\t\t\$%s->withTrashed();\n\t\t}", $this->getVarNamePlural());
        }

        return join("\n", $code);
    }

    public function getSearch() {
        return sprintf("if(!empty(\$request->search)) {\n\t\t\t\$%s->where('%s', 'like', '%%' . \$request->search . '%%');\n\t\t}", $this->getVarNamePlural(), SchemaUtils::firstHumanReadableField($this->mainTable(), 'id') ?: 'id');
    }

    public function getPager() {
        return sprintf('$%s = $%s->paginate(10);', $this->getVarNamePlural(), $this->getVarNamePlural());
    }

    public function getIndexVars() {
        return $this->getVars($this->parentTables(), (array) $this->getVarNamePlural());
    }

    public function getAllVars() {
        return $this->getVars($this->tables);
    }

    public function getParentVars() {
        return $this->getVars($this->parentTables());
    }

    public function getCreateVars() {
        return $this->getVars($this->parentTables(), (array) array_map(fn($field) => $field['related_table'], (array) $this->getExternallyRelatedFields()));
    }

    public function getEditVars() {
        return $this->getVars($this->tables, (array) array_map(fn($field) => $field['related_table'], (array) $this->getExternallyRelatedFields()));
    }

    public function getWith() {
        foreach ($this->getExternallyRelatedFields() as $field) {
            $code[] = sprintf('$%s->with(\'%s\');', $this->getVarNamePlural(), $field['relation']);
        }

        return join("\n\t\t", $code ?? []);
    }

    public function getSelects() {
        foreach ($this->getExternallyRelatedFields() as $field) {
            if (SchemaUtils::getUserIdField($field['related_table'])) {
                $code[] = sprintf("\$%s = \App\Models\%s::where('%s', auth()->id())->get();", NameUtils::getVariableNamePlural($field['related_table']), NameUtils::getModelName($field['related_table']), SchemaUtils::getUserIdField($field['related_table']));
            } else {
                $code[] = sprintf("\$%s = \App\Models\%s::all();", NameUtils::getVariableNamePlural($field['related_table']), NameUtils::getModelName($field['related_table']));
            }
        }

        return join("\n\t\t", $code ?? []);
    }

    public function getValidations(bool $edit) {
        foreach ($this->getFillableFields() as $field) {
            if (preg_match('/boolean|timestamp/', $field['type'])) continue;

            if (!$field['nullable']) {
                $validations[$field['id']] = 'required';
            }

            if (!empty($field['unique'])) {
                $validations[$field['id']] .= (!empty($validations[$field['id']]) ? '|' : '') . "unique:{$this->mainTable()},{$field['id']}";
                if ($edit) {
                    $validations[$field['id']] .= ",\${$this->getVarName()}->id";
                }
            }
        }

        if (!empty($validations)) {
            $keyValues = array_map(fn($key, $value) => sprintf('"%s" => "%s"', $key, $value), array_keys($validations), $validations);
            return sprintf("[%s]", join(", ", $keyValues));
        } else {
            return '[]';
        }
    }

    public function getStore($edit) {
        foreach (SchemaUtils::getTableFields($this->mainTable()) as $field) {
            if ($field['id'] === 'user_id') {
                if (!$edit) $fills[] = sprintf("\$%s->user_id = auth()->id();", $this->getVarName());
            } else if (in_array($field['related_table'] ?? '', $this->tables)) {
                if (!$edit) $fills[] = sprintf("\$%s->%s = \$%s->id;", $this->getVarName(), $field['id'], NameUtils::getVariableName($field['related_table']));
            } else {
                $bool = preg_match('/bool/', $field['type']) ? '!!' : '';
                $fills[] = sprintf("\$%s->%s = %s\$request->%s;", $this->getVarName(), $field['id'], $bool, $field['id']);
            }
        }

        return join("\n\t\t", $fills ?? []);
    }
}
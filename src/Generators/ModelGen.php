<?php

namespace San\Crud\Generators;

use San\Crud\Utils\NameUtils;
use San\Crud\Utils\SchemaUtils;

class ModelGen extends BaseGen {

    public function getUsesModels() {
        return join("\n", array_map(fn($table) => sprintf('use App\Models\%s;', NameUtils::getModelName((array) $table)), $this->tables));
    }

    public function getModelName() {
        return NameUtils::getModelName($this->mainTable());
    }

    public function getSoftDelete() {
        return $this->hasSoftDeletes() ? 'use \Illuminate\Database\Eloquent\SoftDeletes;' : '';
    }

    public function getFillable() {
        foreach ($this->getFillableFields() as $field) {
            $fillable[] = $field['id'];
        }

        return join(', ', array_map(fn($f) => sprintf('"%s"', $f), $fillable ?? []));
    }

    public function getBelongsTo() {
        foreach (SchemaUtils::getTableFieldsWithIds($this->mainTableReal(), ['user_id']) as $field) {
            $relations[] = sprintf("public function %s() {\n\t\treturn \$this->belongsTo(%s::class);\n\t}", $field['relation'], NameUtils::getModelName((array) $field['related_table']));
        }

        return join("\n\n", $relations ?? []);
    }

    public function getHasMany() {
        $tables = SchemaUtils::getTables($this->mainTableReal());

        foreach ($tables as $table) {
            $fields = SchemaUtils::getTableFieldsWithIds($this->getTableNameFromAlias($table), ['user_id']);
            foreach ($fields as $field) {
                if ($field['related_table'] == $this->mainTableReal()) {
                    $fKey = $field['id'];
                    $relations[] = sprintf("public function %s() {\n\t\treturn \$this->hasMany(%s::class, '%s');\n\t}", NameUtils::getVariableNamePlural($table), NameUtils::getModelName((array) $table), $fKey);
                }
            }
        }

        return join("\n\n", $relations ?? []);
    }

    public function getCasts() {
        foreach (SchemaUtils::getTableFields($this->mainTableReal(), ['user_id']) as $field) {
            if ($field['type'] == 'json') {
                $casts[] = sprintf("'%s' => AsArrayObject::class", $field['id']);
            } elseif (preg_match('/^date/', $field['type'])) {
                $casts[] = sprintf("'%s' => 'datetime'", $field['id']);
            }
        }

        return !empty($casts) ? sprintf("protected \$casts = [\n\t\t%s\n\t];", join(",\n\t\t", $casts)) : '';
    }
}

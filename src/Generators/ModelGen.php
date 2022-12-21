<?php

namespace San\Crud\Generators;

use San\Crud\Utils\NameUtils;
use San\Crud\Utils\SchemaUtils;

class ModelGen extends BaseGen {

    public function getModelName() {
        return NameUtils::getModelName($this->mainTable());
    }

    public function getUsesModels() {
        return join("\n", array_map(fn($table) => sprintf('use App\Models\%s;', NameUtils::getModelName((array) $table)), $this->tables));
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
        foreach (SchemaUtils::getTableFieldsWithIds($this->mainTable(), ['user_id']) as $field) {
            $relations[] = sprintf("public function %s() {\n\t\treturn \$this->belongsTo(%s::class);\n\t}", $field['relation'], NameUtils::getModelName((array) $field['related_table']));
        }

        return join("\n\n", $relations ?? []);
    }

    public function getHasMany() {
        foreach (SchemaUtils::getTables($this->mainTable()) as $table) {
            foreach (SchemaUtils::getTableFieldsWithIds($table, ['user_id']) as $field) {
                if ($field['related_table'] == $this->mainTable()) {
                    $relations[] = sprintf("public function %s() {\n\t\treturn \$this->hasMany(%s::class);\n\t}", NameUtils::getVariableNamePlural($table), NameUtils::getModelName((array) $table));
                }
            }
        }

        return join("\n\n", $relations ?? []);
    }

    public function getCasts() {
        foreach (SchemaUtils::getTableFields($this->mainTable(), ['user_id']) as $field) {
            if ($field['type'] == 'json') {
                $casts[] = sprintf("'%s' => AsArrayObject::class", $field['id']);
            }
        }

        return !empty($casts) ? sprintf("protected \$casts = [\n\t\t%s\n\t];", join(",\n\t\t", $casts)) : '';
    }
}

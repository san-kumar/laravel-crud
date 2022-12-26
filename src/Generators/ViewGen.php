<?php

namespace San\Crud\Generators;

use Illuminate\View\Compilers\BladeCompiler;
use San\Crud\Utils\NameUtils;
use San\Crud\Utils\RouteUtils;
use San\Crud\Utils\SchemaUtils;
use San\Crud\Utils\TextUtils;

class ViewGen extends BaseGen {
    public function __construct(public array $tables, public array $aliases = [], public ?string $routePrefix = null) {
        parent::__construct($tables,$aliases);
    }

    public function getViewName() {
        return $this->getVarName();
    }

    public function getBreadcrumbs($template, $path) {
        $index = 1;
        $total = (count($this->tables) * 2) - 1;

        foreach ($this->tables as $table) {
            $tables[] = $table;

            if (!empty($lastTables)) {
                $lastTable = $lastTables[count($lastTables) - 1];
                $href = RouteUtils::makeRoute(NameUtils::getRouteName($lastTables) . '.show', $this->getRawVars($lastTables), $this->routePrefix);
                $anchorText = sprintf('%s #{{ $%s->id }}', NameUtils::titleCase($lastTable), NameUtils::getVariableName($lastTable));
                $links[] = $this->render($template, $path, [], ['href' => "{{ $href }}", 'anchortext' => $anchorText, 'index' => $index++, 'total' => $total]);
            }

            $href = RouteUtils::makeRoute(NameUtils::getRouteName($tables) . '.index', $this->getRawVars(array_slice($tables, 0, -1)), $this->routePrefix);
            $anchorText = NameUtils::titleCase($table);
            $links[] = $this->render($template, $path, [], ['href' => "{{ $href }}", 'anchortext' => $anchorText, 'index' => $index++, 'total' => $total]);

            $lastTables[] = $table;
        }

        return join("\n\t\t\t\t\t\t", $links ?? []);
    }

    public function genForm(string $template, string $path, array $replacements, bool $edit) {
        $input = function ($f) use ($edit, $path) {
            $type = (!empty($f->values) ? 'select' : (preg_match('/text/i', $f->type) ? 'textarea' : (preg_match('/bool/i', $f->type) ? 'boolean' : (preg_match('/json/i', $f->type) ? 'json' : 'input'))));
            $val = $edit ? sprintf('@old(\'%s\', %s)', $f->id, $f->type === 'json' ? "json_encode(\$_var_->{$f->id})" : "\$_var_->{$f->id}") : sprintf('@old(\'%s\')', $f->id);
            $inputType = preg_match('/int|double|float|decimal/i', $f->type) ? 'number' : (preg_match('/mail/i', $f->id) ? 'email' : (preg_match('/password/i', $f->id) ? 'password' : (preg_match('/datetime/i', $f->type) ? 'datetime-local' : (preg_match('/date/i', $f->type) ? 'date' : (preg_match('/time/i', $f->type) ? 'time' : 'text')))));
            $vars = ['_id_' => $f->id, '_name_' => $f->name, '_enums_' => TextUtils::arrayExport($f->values ?? [], TRUE), '_val_' => $val, '_type_' => $inputType, '_required_' => $f->nullable ? '' : 'required'];

            if (!empty($f->relation)) {
                $type = 'related';
                $vars['_related_'] = NameUtils::getVariableName($f->related_table);
                $vars['_relateds_'] = NameUtils::getVariableNamePlural($f->related_table);
                $vars['_readable_'] = SchemaUtils::firstHumanReadableField($this->getTableNameFromAlias($f->related_table), 'id') ?: 'id';
                $vars['_relatedroute_'] = RouteUtils::makeRoute($vars['_relateds_'] . '.create', [], $this->routePrefix);
            }

            return trim(strtr(file_get_contents("$path/inputs/$type.blade.php"), $vars));
        };

        $err = function ($f) {
            return sprintf("@if(\$errors->has('%s'))\n\t\t\t<div class='error small text-danger'>{{\$errors->first('%s')}}</div>\n\t\t@endif", $f->id, $f->id);
        };

        return $this->render($template, $path, $replacements, ['input' => $input, 'err' => $err]);
    }

    public function genIndex(string $template, string $path = '', array $replacements = []) {
        $display = function ($f) use ($path) {
            if (!empty($f->relation)) {
                if ($index = array_search($f->related_table, $this->parentTables())) {
                    $tables = array_slice($this->parentTables(), 0, $index + 1);

                    return sprintf('<a href="{{%s}}" class="text-dark">{{$_var_?->%s?->%s ?: "(blank)"}}</a>',
                        RouteUtils::makeRoute(NameUtils::getRouteName($tables) . '.show', $this->getRawVars($tables), $this->routePrefix), $f->relation, SchemaUtils::firstHumanReadableField($this->getTableNameFromAlias($f->related_table), 'id') ?? 'id');
                } else {
                    return sprintf('<a href="{{%s}}" class="text-dark">{{$_var_?->%s?->%s ?: "(blank)"}}</a>',
                        RouteUtils::makeRoute(NameUtils::getRouteName($f->related_table) . '.show', "\$_var_->$f->id ?: 0", $this->routePrefix), $f->relation, SchemaUtils::firstHumanReadableField($this->getTableNameFromAlias($f->related_table), 'id') ?? 'id');
                }
            } else {
                $type = preg_match('/(json|boolean|text)/', $f->type) ? $f->type : 'string';
                return trim(strtr(file_get_contents("$path/display/$type.blade.php"), ['_col_' => $f->id]));
            }
        };


        return $this->render($template, $path, $replacements, ['display' => $display]);
    }

    protected function render($f, $path, $replacements, $vars) {
        $fields = array_map(fn($f) => (object) array_merge($f, ['name' => preg_replace('/ Id$/', '', $f['name'])]), $this->getFillableFields(['user_id']));
        $readable = $this->getFirstReadableField('id');
        $vars = array_merge(['fields' => $fields, 'hasSoftDelete' => $this->hasSoftDeletes(), 'hasTimestamps' => $this->hasTimestamps(), 'render' => fn($f) => call_user_func_array([$this, 'render'], [$f, $path, $replacements, $vars])], (array) $vars);
        $template = file_get_contents("$path/$f.blade.php");
        $str = BladeCompiler::render($template, $vars);
        $str = TextUtils::replaceBlanks($str, array_merge((array) $replacements, ['readable' => $readable]));

        return $str;
    }
}

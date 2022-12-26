<?php

namespace San\Crud\Generators;

use San\Crud\Utils\NameUtils;

class RouteGen extends BaseGen {
    public function __construct(public array $tables, public array $aliases = [], public ?string $routePrefix = NULL) {
        parent::__construct($tables, $aliases);
    }

    public function getRouteName() {
        return NameUtils::getRouteName($this->tables);
    }

    public function getParentRouteName() {
        return NameUtils::getRouteName($this->parentTables());
    }

    public function getRouteUrl() {
        return $this->withRoutePrefix(str_replace('.', '/', $this->getRouteName()));
    }

    public function getRouteUrlWithoutPrefix() {
        return str_replace('.', '/', $this->getRouteName());
    }

    public function getRouteUrlWithPlaceholders() {
        return $this->getUrlWithPlaceholders($this->tables);
    }

    public function getParentRouteUrlWithPlaceholders() {
        return $this->getUrlWithPlaceholders($this->parentTables(), $this->mainTable());
    }

    public function getUrlWithPlaceholders($tables, $suffix = '') {
        foreach ((array) $tables as $table) {
            $parts[] = sprintf('%s/{%s}', $table, NameUtils::getVariableName($table));
        }

        if (!empty($suffix)) {
            $parts[] = $suffix;
        }

        return $this->withRoutePrefix(implode('/', $parts ?? []));
    }

    public function getRouteUrlWithId() {
        foreach ((array) $this->tables as $table) {
            if ($table == $this->mainTable()) {
                $parts[] = sprintf('%s/{%s_id}', $table, NameUtils::getVariableName($table));
            } else {
                $parts[] = sprintf('%s/{%s}', $table, NameUtils::getVariableName($table));
            }
        }

        return $this->withRoutePrefix(implode('/', $parts));
    }

    public function getParentRouteUrl() {
        return $this->withRoutePrefix(str_replace('.', '/', $this->getParentRouteName()));
    }

    public function getRouteVars() {
        return sprintf('[%s]', join(', ', array_map(fn($table) => sprintf("'%s' => $%s", NameUtils::getVariableName($table), NameUtils::getVariableName($table)), $this->tables)));
    }

    public function getRouteVarsWithId() {
        foreach ($this->tables as $table) {
            if ($table == $this->mainTable()) {
                $vars[] = sprintf("'%s_id' => $%s->id", NameUtils::getVariableName($table), NameUtils::getVariableName($table));
            } else {
                $vars[] = sprintf("'%s' => $%s", NameUtils::getVariableName($table), NameUtils::getVariableName($table));
            }
        }

        return sprintf('[%s]', join(', ', $vars ?? []));
    }

    public function getAsRoute() {
        return $this->hasParentTable() ? sprintf('"as" => "%s",', $this->getParentRouteName()) : '';
    }

    public function withRoutePrefix(string $route) {
        return empty($this->routePrefix) ? $route : sprintf('%s/%s', trim($this->routePrefix, '/'), $route);
    }

}

<?php

namespace San\Crud\Generators;

use San\Crud\Utils\NameUtils;
use San\Crud\Utils\SchemaUtils;

class PolicyGen extends BaseGen {

    public function getPolicyName() {
        return NameUtils::getPolicyName($this->mainTable());
    }

    public function getUsesPolicies() {
        return sprintf('use %s;', NameUtils::getPolicyName((array) $this->tables));
    }

    public function getControllerPolicy() {
        return sprintf("public function __construct() {\n\t\t\$this->authorizeResource(%s::class, '%s');\n\t}", NameUtils::getModelName((array) $this->mainTable()), NameUtils::getVariableName($this->mainTable()));
    }

    public function getPolicyReadArgs() {
        return $this->getPolicyArgs([]);
    }

    public function getPolicyReadRules() {
        return $this->getPolicyRules([]);
    }

    public function getPolicyWriteArgs() {
        return $this->getPolicyArgs($this->mainTable());
    }

    public function getPolicyWriteRules() {
        return $this->getPolicyRules($this->mainTable());
    }

    public function getPolicyRules($tables) {
        foreach ((array) $tables as $table) {
            if (SchemaUtils::getUserIdField($table)) {
                $checks[] = sprintf('($%s->user_id == $user->id)', NameUtils::getVariableName($table));
            }
        }

        return empty($checks) ? "return true;" : sprintf('return ($user->id > 0) && %s;', join(' && ', $checks));
    }

    public function getPolicyArgs($tables) {
        return join(', ', array_map(fn($table) => sprintf('%s $%s', NameUtils::getModelName((array) $table), NameUtils::getVariableName($table)), array_merge(['User'], (array) $tables)));
    }

    public function getParentAuthorization() {
        return $this->getPolicyAuthorization($this->parentTables(), 'view');
    }

    public function getModelAuthorization() {
        return $this->getPolicyAuthorization($this->mainTable(), 'delete');
    }

    public function getPolicyAuthorization($tables, $fn) {
        foreach ((array) $tables as $table) {
            $checks[] = sprintf("\$this->authorize('%s', [%s::class, \$%s]);", $fn, NameUtils::getModelName($table), NameUtils::getVariableName($table));
        }

        return empty($checks) ? "" : join("\n\t\t", $checks);
    }
}

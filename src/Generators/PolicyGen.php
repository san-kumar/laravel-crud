<?php

namespace San\Crud\Generators;

use San\Crud\Utils\NameUtils;
use San\Crud\Utils\SchemaUtils;

class PolicyGen extends BaseGen {

    public function getUsesPolicies() {
        return sprintf('use %s;', NameUtils::getPolicyName((array) $this->tables));
    }

    public function getPolicyName() {
        return NameUtils::getPolicyName($this->mainTable());
    }

    public function getControllerPolicy() {
        return sprintf("public function __construct() {\n\t\t\$this->authorizeResource(%s::class, '%s');\n\t}", $this->getMainModelName(), $this->getMainVarName());
    }

    public function getPolicyReadArgs() {
        return $this->getPolicyArgs([]);
    }

    public function getPolicyArgs($tables) {
        foreach (array_merge(['User'], (array) $tables) as $table) {
            $args[] = sprintf('%s $%s', NameUtils::getModelName((array) $table), NameUtils::getVariableName($table));
        }

        return join(', ', $args ?? []);
    }

    public function getPolicyReadRules() {
        return $this->getPolicyRules([]);
    }

    public function getPolicyRules($tables) {
        foreach ((array) $tables as $table) {
            if (SchemaUtils::getUserIdField($this->getTableNameFromAlias($table))) {
                $checks[] = sprintf('($%s->user_id == $user->id)', NameUtils::getVariableName($table));
            }
        }

        return empty($checks) ? "return true;" : sprintf('return ($user->id > 0) && %s;', join(' && ', $checks));
    }

    public function getPolicyWriteArgs() {
        return $this->getPolicyArgs($this->mainTable());
    }

    public function getPolicyWriteRules() {
        return $this->getPolicyRules($this->mainTable());
    }

    public function getParentAuthorization() {
        return $this->getPolicyAuthorization($this->parentTables(), 'view');
    }

    public function getPolicyAuthorization($tables, $fn) {
        foreach ((array) $tables as $table) {
            $checks[] = sprintf("\$this->authorize('%s', [%s::class, \$%s]);", $fn, NameUtils::getModelName($table), NameUtils::getVariableName($table));
        }

        return empty($checks) ? "" : join("\n\t\t", $checks);
    }

    public function getModelAuthorization() {
        return $this->getPolicyAuthorization($this->mainTable(), 'delete');
    }
}

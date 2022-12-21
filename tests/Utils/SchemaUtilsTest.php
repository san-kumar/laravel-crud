<?php

namespace San\Crud\Tests\Utils;

use San\Crud\Tests\TestCase;
use San\Crud\Utils\SchemaUtils;

class SchemaUtilsTest extends TestCase {
    public function testHasTimestamps() {
        $this->assertTrue(SchemaUtils::hasTimestamps('users'));
        $this->assertFalse(SchemaUtils::hasTimestamps('countries'));
    }

    public function testFirstHumanReadableField() {
        $this->assertEquals('name', SchemaUtils::firstHumanReadableField('users', 'id'));
    }

    public function testHasTable() {
        $this->assertTrue(SchemaUtils::hasTable('users'));
        $this->assertFalse(SchemaUtils::hasTable('not_exists'));
    }

    public function testGetTables() {
        $tables = SchemaUtils::getTables(['users']);
        $this->assertIsArray($tables);
        $this->assertGreaterThan(0, count($tables));
        $this->assertContains('migrations', $tables);
        $this->assertNotContains('users', $tables);
    }

    public function testGetTableFields() {
        $fields = SchemaUtils::getTableFields('users');
        $this->assertIsArray($fields);
        $this->assertGreaterThan(0, count($fields));

        $ids = array_column($fields, 'id');
        $this->assertContains('email', $ids);
        $this->assertNotContains('id', $ids);
    }

    public function testGetTableFieldsWithIds() {
        $fields = SchemaUtils::getTableFieldsWithIds('tickets');
        $this->assertIsArray($fields);
        $tables = array_column($fields, 'related_table');
        $this->assertContains('leads', $tables);
        $this->assertNotContains('tickets', $tables);
    }

    public function testGetUserIdField() {
        $this->assertEquals('user_id', SchemaUtils::getUserIdField('tickets'));
    }

    public function testHasSoftDelete() {
        $this->assertTrue(SchemaUtils::hasSoftDelete('leads'));
        $this->assertFalse(SchemaUtils::hasSoftDelete('tickets'));
    }
}

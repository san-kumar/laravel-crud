<?php

namespace San\Crud\Tests\Generators;

use San\Crud\Generators\BaseGen;
use San\Crud\Tests\TestCase;

class BaseGenTest extends TestCase {

    public function testGetVarName() {
        $baseGen = new BaseGen(['users']);
        $this->assertEquals('user', $baseGen->getVarName());
    }

    public function testGetParentVarNamePlural() {
        $baseGen = new BaseGen(['users', 'posts']);
        $this->assertEquals('users', $baseGen->getParentVarNamePlural());
    }

    public function testGetTitle() {
        $baseGen = new BaseGen(['users']);
        $this->assertEquals('User', $baseGen->getTitle());
    }

    public function testGetTitlePlural() {
        $baseGen = new BaseGen(['users']);
        $this->assertEquals('Users', $baseGen->getTitlePlural());
    }

    public function testGetVars() {
        $baseGen = new BaseGen(['users', 'posts']);
        $vars = $baseGen->getVars(['users', 'posts'],['comments']);
        $this->assertEquals("compact('user', 'post', 'comments')", $vars);
    }

    public function testMainTable() {
        $baseGen = new BaseGen(['users', 'posts']);
        $this->assertEquals('posts', $baseGen->mainTable());
    }

    public function testGetVarNamePlural() {
        $baseGen = new BaseGen(['users']);
        $this->assertEquals('users', $baseGen->getVarNamePlural());
    }

    public function testHasParentTable() {
        $baseGen = new BaseGen(['users', 'posts']);
        $this->assertTrue($baseGen->hasParentTable());
    }

    public function testParentTable() {
        $baseGen = new BaseGen(['users', 'posts']);
        $this->assertEquals('users', $baseGen->parentTable());
    }

    public function testParentTables() {
        $baseGen = new BaseGen(['users', 'posts']);
        $this->assertEquals(['users'], $baseGen->parentTables());
    }

    public function testGetParentVarName() {
        $baseGen = new BaseGen(['users', 'posts']);
        $this->assertEquals('user', $baseGen->getParentVarName());
    }
}

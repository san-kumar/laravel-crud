<?php

namespace San\Crud\Tests\Utils;

use San\Crud\Tests\TestCase;
use San\Crud\Utils\NameUtils;

class NameUtilsTest extends TestCase {

    public function testGetVariableNamePlural() {
        $this->assertEquals('users', NameUtils::getVariableNamePlural('Users'));
        $this->assertEquals('users', NameUtils::getVariableNamePlural('users'));
    }

    public function testGetVariableName() {
        $this->assertEquals('user', NameUtils::getVariableName('Users'));
        $this->assertEquals('user', NameUtils::getVariableName('users'));
    }

    public function testGetPolicyName() {
        $this->assertEquals('UserPolicy', NameUtils::getPolicyName('Users'));
        $this->assertEquals('UserPolicy', NameUtils::getPolicyName('users'));
    }

    public function testStudlyCase() {
        $this->assertEquals('User', NameUtils::studlyCase('Users'));
        $this->assertEquals('User', NameUtils::studlyCase('users'));
    }

    public function testGetModelName() {
        $this->assertEquals('User', NameUtils::getModelName('Users'));
        $this->assertEquals('User', NameUtils::getModelName('users'));
    }

    public function testGetControllerName() {
        $this->assertEquals('UserController', NameUtils::getControllerName('Users'));
        $this->assertEquals('UserController', NameUtils::getControllerName('users'));
    }

    public function testTitleCase() {
        $this->assertEquals('Users', NameUtils::titleCase('Users'));
        $this->assertEquals('Users Table', NameUtils::titleCase('users table'));
    }

    public function testGetRouteName() {
        $this->assertEquals('users', NameUtils::getRouteName('Users'));
        $this->assertEquals('users', NameUtils::getRouteName('users'));
        $this->assertEquals('blogs.posts.comments', NameUtils::getRouteName(['blogs', 'posts', 'comments']));
    }
}

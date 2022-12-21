<?php

namespace San\Crud\Tests\Generators;

use San\Crud\Generators\Templates;
use San\Crud\Tests\TestCase;

class TemplatesTest extends TestCase {
    public function testInvalidPath() {
        $this->expectException(\Exception::class);
        $templates = new Templates('invalid/path');
    }

    public function testGetStubs() {
        $templates = new Templates($this->template_dir);
        $stubs = $templates->getStubs('Controllers');
        $this->assertNotEmpty($stubs);
    }

    public function testGetFirstStub() {
        $templates = new Templates($this->template_dir);
        $stub = $templates->getFirstStub('Controllers');
        $this->assertNotEmpty($stub);
    }

    public function testGetDest() {
        $templates = new Templates($this->template_dir);
        $stub = $templates->getFirstStub('Controllers');
        $dest = $templates->getDest('Controllers', $stub, ['controller' => 'Test']);
        $this->assertNotEmpty($dest);
        $this->assertStringContainsString('Http/Controllers/Test.php', $dest);
    }
}

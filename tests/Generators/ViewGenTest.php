<?php

namespace San\Crud\Tests\Generators;

use San\Crud\Generators\ViewGen;
use San\Crud\Tests\TestCase;

class ViewGenTest extends TestCase {
    protected $partials_dir;

    public function setUp(): void {
        parent::setUp();
        $this->partials_dir = $this->template_dir . '/stubs/views/bootstrap/partials';
    }

    public function testGenIndex() {
        $gen = new ViewGen(['leads', 'tickets']);
        $info = $gen->genIndex('render/table', $this->partials_dir, ['var' => 'test']);
        $this->assertStringContainsString('$test->subject', $info);
        $this->assertStringContainsString('_route_.destroy', $info);

        $gen = new ViewGen(['leads', 'tickets', 'replies']);
        $info = $gen->genIndex('render/table', $this->partials_dir, ['var' => 'test']);
        $this->assertStringContainsString('$test->is_admin', $info);
        $this->assertStringContainsString('_route_.destroy', $info);
    }

    public function testGenForm() {
        //test create first
        $gen = new ViewGen(['leads', 'tickets']);
        $info = $gen->genForm('render/form', $this->partials_dir, ['var' => 'test'], false);
        $this->assertStringContainsString('type="text" name="subject"', $info);
        $this->assertStringContainsString('$errors->first(\'subject\')', $info);
    }

    public function testGetBreadcrumbs() {
        $gen = new ViewGen(['leads', 'tickets']);
        $info = $gen->getBreadcrumbs();
        $this->assertStringContainsString("route('leads.index'", $info);
        $this->assertStringContainsString("route('leads.tickets.index'", $info);
        $this->assertStringContainsString("compact('lead')", $info);
    }
}

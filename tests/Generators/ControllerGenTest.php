<?php

namespace San\Crud\Tests\Generators;

use San\Crud\Generators\ControllerGen;
use San\Crud\Tests\TestCase;

class ControllerGenTest extends TestCase {

    public function testGetIndexVars() {
        $controllerGen = new ControllerGen(['users']);
        $vars = $controllerGen->getIndexVars();
        $this->assertEquals("compact('users')", $vars);
    }

    public function testGetWith() {
        $controllerGen = new ControllerGen(['tickets']);
        $with = $controllerGen->getWith();
        $this->assertEquals("\$tickets->with('lead');", $with);
    }

    public function testGetControllerAllArgs() {
        $controllerGen = new ControllerGen(['tickets', 'leads']);
        $args = $controllerGen->getControllerAllArgs();
        $this->assertEquals("Ticket \$ticket, Lead \$lead,", $args);
    }

    public function testGetSearch() {
        $controllerGen = new ControllerGen(['tickets']);
        $search = $controllerGen->getSearch();
        $this->assertStringContainsString("\$tickets->where('subject', 'like'", $search);
    }

    public function testGetValidations() {
        $controllerGen = new ControllerGen(['users']);
        $validations = $controllerGen->getValidations(true);
        $this->assertStringContainsString('"required|unique:users,email,$user->id"', $validations);
    }

    public function testGetQuery() {
        $controllerGen = new ControllerGen(['tickets']);
        $query = $controllerGen->getQuery();
        $this->assertStringContainsString("\$tickets = Ticket::query();", $query);
    }

    public function testGetControllerArgs() {
        $controllerGen = new ControllerGen(['tickets', 'leads']);
        $args = $controllerGen->getControllerArgs(['tickets']);
        $this->assertEquals("Ticket \$ticket,", $args);
    }

    public function testGetParentVars() {
        $controllerGen = new ControllerGen(['tickets', 'leads']);
        $vars = $controllerGen->getParentVars();
        $this->assertEquals("compact('ticket')", $vars);
    }

    public function testGetControllerName() {
        $controllerGen = new ControllerGen(['tickets']);
        $name = $controllerGen->getControllerName();
        $this->assertEquals("TicketController", $name);
    }

    public function testGetCreateVars() {
        //this loads all leads
        $controllerGen = new ControllerGen(['tickets']);
        $vars = $controllerGen->getCreateVars();
        $this->assertEquals("compact('leads')", $vars);

        //this only loads the lead that is associated with the ticket
        $controllerGen = new ControllerGen(['leads', 'tickets']);
        $vars = $controllerGen->getCreateVars();
        $this->assertEquals("compact('lead')", $vars);
    }

    public function testGetSelects() {
        //this loads all leads
        $controllerGen = new ControllerGen(['tickets']);
        $selects = $controllerGen->getSelects();
        $this->assertStringContainsString("Lead::where('user_id', auth()->id())->get();", $selects);

        //this only loads the lead that is associated with the ticket
        $controllerGen = new ControllerGen(['leads', 'tickets']);
        $selects = $controllerGen->getSelects();
        $this->assertEmpty($selects);
    }

    public function testGetEditVars() {
        //this loads all leads
        $controllerGen = new ControllerGen(['tickets']);
        $vars = $controllerGen->getEditVars();
        $this->assertEquals("compact('ticket', 'leads')", $vars);

        //this only loads the lead that is associated with the ticket
        $controllerGen = new ControllerGen(['leads', 'tickets']);
        $vars = $controllerGen->getEditVars();
        $this->assertEquals("compact('lead', 'ticket')", $vars);
    }

    public function testGetStore() {
        //create a ticket


        //check lead_id is assigned from request
        $controllerGen = new ControllerGen(['tickets']);
        $store = $controllerGen->getStore(FALSE);
        $this->assertStringContainsString("\$ticket->lead_id = \$request->lead_id", $store);

        //check lead_id is assigned from parent table
        $controllerGen = new ControllerGen(['leads', 'tickets']);
        $store = $controllerGen->getStore(FALSE);
        $this->assertStringContainsString("\$ticket->lead_id = \$lead->id", $store);
        $this->assertStringContainsString("\$ticket->user_id = auth()->id()", $store);

        //edit a ticket
        //check lead_id is never assigned again
        $controllerGen = new ControllerGen(['leads', 'tickets']);
        $store = $controllerGen->getStore(TRUE);
        $this->assertStringNotContainsString("\$ticket->lead_id = \$lead->id;", $store);
    }

    public function testGetAllVars() {
        $controllerGen = new ControllerGen(['tickets']);
        $vars = $controllerGen->getAllVars();
        $this->assertEquals("compact('ticket')", $vars);

        $controllerGen = new ControllerGen(['leads', 'tickets']);
        $vars = $controllerGen->getAllVars();
        $this->assertEquals("compact('lead', 'ticket')", $vars);
    }

    public function testGetPager() {
        $controllerGen = new ControllerGen(['tickets']);
        $pager = $controllerGen->getPager();
        $this->assertStringContainsString("\$tickets = \$tickets->paginate(10);", $pager);
    }

    public function testGetControllerParentArgs() {
        $controllerGen = new ControllerGen(['tickets']);
        $args = $controllerGen->getControllerParentArgs();
        $this->assertEmpty($args);

        $controllerGen = new ControllerGen(['leads', 'tickets']);
        $args = $controllerGen->getControllerParentArgs();
        $this->assertEquals("Lead \$lead,", $args);
    }

    public function testGetFindById() {
        $controllerGen = new ControllerGen(['tickets']);
        $find = $controllerGen->getFindById();
        $this->assertStringContainsString("->find(\$ticket_id)", $find);
    }
}

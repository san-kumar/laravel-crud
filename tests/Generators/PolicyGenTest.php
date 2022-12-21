<?php

namespace San\Crud\Tests\Generators;

use San\Crud\Generators\PolicyGen;
use San\Crud\Tests\TestCase;

class PolicyGenTest extends TestCase {

    public function testGetUsesPolicies() {
        $policyGen = new PolicyGen(['tickets']);
        $usesPolicies = $policyGen->getUsesPolicies();
        $this->assertStringContainsString("use TicketPolicy", $usesPolicies);
    }

    public function testGetControllerPolicy() {
        $policyGen = new PolicyGen(['tickets']);
        $controllerPolicy = $policyGen->getControllerPolicy();
        $this->assertStringContainsString("Ticket::class", $controllerPolicy);
    }

    public function testGetPolicyWriteArgs() {
        $policyGen = new PolicyGen(['tickets']);
        $policyWriteArgs = $policyGen->getPolicyWriteArgs();
        $this->assertStringContainsString("Ticket \$ticket", $policyWriteArgs);
    }

    public function testGetPolicyReadArgs() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $policyReadArgs = $policyGen->getPolicyReadArgs(['tickets']);
        $this->assertStringContainsString("User \$user", $policyReadArgs);
    }

    public function testGetPolicyReadRules() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $policyReadRules = $policyGen->getPolicyReadRules();
        $this->assertStringContainsString("return true;", $policyReadRules);

    }

    public function testGetParentAuthorization() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $parentAuthorization = $policyGen->getParentAuthorization();
        $this->assertStringContainsString("authorize('view', [Lead::class, \$lead]", $parentAuthorization);
    }

    public function testGetPolicyRules() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $policyRules = $policyGen->getPolicyRules(['tickets']);
        $this->assertStringContainsString("\$ticket->user_id == \$user->id", $policyRules);
    }

    public function testGetPolicyWriteRules() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $policyWriteRules = $policyGen->getPolicyWriteRules(['tickets']);
        $this->assertStringContainsString("\$ticket->user_id == \$user->id", $policyWriteRules);
    }

    public function testGetModelAuthorization() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $modelAuthorization = $policyGen->getModelAuthorization();
        $this->assertStringContainsString("authorize('delete', [Ticket::class, \$ticket])", $modelAuthorization);
    }

    public function testGetPolicyAuthorization() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $policyAuthorization = $policyGen->getPolicyAuthorization(['tickets'], 'test');
        $this->assertStringContainsString("authorize('test', [Ticket::class, \$ticket])", $policyAuthorization);
    }

    public function testGetPolicyName() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $policyName = $policyGen->getPolicyName();
        $this->assertStringContainsString("TicketPolicy", $policyName);
    }

    public function testGetPolicyArgs() {
        $policyGen = new PolicyGen(['leads', 'tickets']);
        $policyArgs = $policyGen->getPolicyArgs(['tickets']);
        $this->assertStringContainsString("Ticket \$ticket", $policyArgs);
    }
}

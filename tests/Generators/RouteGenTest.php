<?php

namespace San\Crud\Tests\Generators;

use San\Crud\Generators\RouteGen;
use San\Crud\Tests\TestCase;

class RouteGenTest extends TestCase {

    public function testGetRouteUrlWithPlaceholders() {
        $routeGen = new RouteGen(['tickets']);
        $routeUrlWithPlaceholders = $routeGen->getRouteUrlWithPlaceholders();
        $this->assertStringContainsString("tickets/{ticket}", $routeUrlWithPlaceholders);
    }

    public function testGetParentRouteName() {
        $routeGen = new RouteGen(['tickets']);
        $parentRouteName = $routeGen->getParentRouteName();
        $this->assertStringContainsString("", $parentRouteName);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $parentRouteName = $routeGen->getParentRouteName();
        $this->assertStringContainsString("leads", $parentRouteName);
    }

    public function testGetRouteName() {
        $routeGen = new RouteGen(['tickets']);
        $routeName = $routeGen->getRouteName();
        $this->assertStringContainsString("tickets", $routeName);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $routeName = $routeGen->getRouteName();
        $this->assertStringContainsString("leads.tickets", $routeName);
    }

    public function testGetRouteUrl() {
        $routeGen = new RouteGen(['tickets']);
        $routeUrl = $routeGen->getRouteUrl();
        $this->assertStringContainsString("tickets", $routeUrl);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $routeUrl = $routeGen->getRouteUrl();
        $this->assertStringContainsString("leads/tickets", $routeUrl);
    }

    public function testGetParentRouteUrlWithPlaceholders() {
        $routeGen = new RouteGen(['tickets']);
        $parentRouteUrlWithPlaceholders = $routeGen->getParentRouteUrlWithPlaceholders();
        $this->assertStringContainsString("", $parentRouteUrlWithPlaceholders);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $parentRouteUrlWithPlaceholders = $routeGen->getParentRouteUrlWithPlaceholders();
        $this->assertStringContainsString("leads/{lead}", $parentRouteUrlWithPlaceholders);
    }

    public function testGetRouteVars() {
        $routeGen = new RouteGen(['tickets']);
        $routeVars = $routeGen->getRouteVars();
        $this->assertStringContainsString("['ticket' => \$ticket]", $routeVars);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $routeVars = $routeGen->getRouteVars();
        $this->assertStringContainsString("['lead' => \$lead, 'ticket' => \$ticket]", $routeVars);
    }

    public function testGetRouteUrlWithId() {
        $routeGen = new RouteGen(['tickets']);
        $routeUrlWithId = $routeGen->getRouteUrlWithId();
        $this->assertStringContainsString("tickets/{ticket_id}", $routeUrlWithId);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $routeUrlWithId = $routeGen->getRouteUrlWithId();
        $this->assertStringContainsString("leads/{lead}/tickets/{ticket_id}", $routeUrlWithId);
    }

    public function testGetParentRouteUrl() {
        $routeGen = new RouteGen(['tickets']);
        $parentRouteUrl = $routeGen->getParentRouteUrl();
        $this->assertStringContainsString("", $parentRouteUrl);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $parentRouteUrl = $routeGen->getParentRouteUrl();
        $this->assertStringContainsString("leads", $parentRouteUrl);
    }

    public function testGetRouteVarsWithId() {
        $routeGen = new RouteGen(['tickets']);
        $routeVarsWithId = $routeGen->getRouteVarsWithId();
        $this->assertStringContainsString("['ticket_id' => \$ticket->id]", $routeVarsWithId);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $routeVarsWithId = $routeGen->getRouteVarsWithId();
        $this->assertStringContainsString("['lead' => \$lead, 'ticket_id' => \$ticket->id]", $routeVarsWithId);
    }

    public function testGetAsRoute() {
        $routeGen = new RouteGen(['tickets']);
        $asRoute = $routeGen->getAsRoute();
        $this->assertStringContainsString("", $asRoute);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $asRoute = $routeGen->getAsRoute();
        $this->assertStringContainsString("leads", $asRoute);
    }

    public function testGetUrlWithPlaceholders() {
        $routeGen = new RouteGen(['tickets']);
        $urlWithPlaceholders = $routeGen->getUrlWithPlaceholders([], '');
        $this->assertStringContainsString("", $urlWithPlaceholders);

        $routeGen = new RouteGen(['leads', 'tickets']);
        $urlWithPlaceholders = $routeGen->getUrlWithPlaceholders(['tickets'], '');
        $this->assertStringContainsString("tickets/{ticket}", $urlWithPlaceholders);
    }
}

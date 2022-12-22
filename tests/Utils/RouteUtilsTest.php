<?php

namespace San\Crud\Tests\Utils;

use Illuminate\Support\Facades\Route;
use San\Crud\Tests\TestCase;
use San\Crud\Utils\RouteUtils;

class RouteUtilsTest extends TestCase {

    public function testMakeRoute() {
        $route = RouteUtils::makeRoute('customers.leads.index', ['customer', 'lead'], 'admin');
        $this->assertStringContainsString("['/admin','customers',\$customer?->id ?: 0,'leads',\$lead?->id ?: 0]", $route);

        Route::shouldReceive('has')->andReturn(TRUE);
        $route = RouteUtils::makeRoute('customers.leads.index', ['customer', 'lead'], 'admin');
        $this->assertStringContainsString("compact('customer', 'lead')", $route);
    }
}

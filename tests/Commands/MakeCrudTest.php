<?php

namespace San\Crud\Tests\Commands;


use Illuminate\Support\Facades\Artisan;
use San\Crud\Tests\TestCase;

class MakeCrudTest extends TestCase {

    public function testHandle() {
        $files = ['app/Http/Controllers/TicketController.php', 'app/Models/Ticket.php', 'app/Policies/TicketPolicy.php', 'resources/views/tickets/index.blade.php', 'resources/views/tickets/create.blade.php', 'resources/views/tickets/edit.blade.php', 'resources/views/tickets/show.blade.php', 'routes/tickets.php'];
        $dests = array_map(fn($file) => preg_match('/^app/', $file) ? app_path(preg_replace('#^(\w+)/#', '', $file)) : (preg_match('/^route/', $file) ? preg_replace('#routes/#', 'routes/crud/', base_path($file)) : resource_path(preg_replace('#^(\w+)/#', '', $file))), $files);

        foreach ($dests as $dest) {
            if (file_exists($dest)) @unlink($dest);
            $this->assertFileDoesNotExist($dest);
        }

        $exitCode = $this->withoutMockingConsoleOutput()
            ->artisan('make:crud', ['table' => 'tickets']);
        $result = Artisan::output();
        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString('TicketController.php', $result);

        foreach ($dests as $dest) {
            $this->assertFileExists($dest);
        }

        $files = ['app/Http/Controllers/LeadTicketController.php', 'app/Models/Ticket.php', 'app/Policies/TicketPolicy.php', 'resources/views/leads/tickets/index.blade.php', 'resources/views/leads/tickets/create.blade.php', 'resources/views/leads/tickets/edit.blade.php', 'resources/views/leads/tickets/show.blade.php', 'routes/leads.tickets.php'];
        $dests = array_map(fn($file) => preg_match('/^app/', $file) ? app_path(preg_replace('#^(\w+)/#', '', $file)) : (preg_match('/^route/', $file) ? preg_replace('#routes/#', 'routes/crud/', base_path($file)) : resource_path(preg_replace('#^(\w+)/#', '', $file))), $files);

        foreach ($dests as $dest) {
            if (file_exists($dest)) @unlink($dest);
            $this->assertFileDoesNotExist($dest);
        }

        $exitCode = $this->withoutMockingConsoleOutput()
            ->artisan('make:crud', ['table' => 'leads.tickets']);
        $result = Artisan::output();
        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString('TicketController.php', $result);

        foreach ($dests as $dest) {
            $this->assertFileExists($dest);
        }
    }

}

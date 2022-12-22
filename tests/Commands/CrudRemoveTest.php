<?php

namespace San\Crud\Tests\Commands;

use Illuminate\Support\Facades\Artisan;
use San\Crud\Tests\TestCase;

class CrudRemoveTest extends TestCase {

    public function testHandle() {
        $zipFn = storage_path('app/crud-backup.zip');

        $exitCode = $this->withoutMockingConsoleOutput()
            ->artisan('crud:generate', ['table' => 'tickets']);
        $result = Artisan::output();
        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString('TicketController.php', $result);
        $this->assertFileExists(app_path('Http/Controllers/TicketController.php'));


        if (file_exists($zipFn)) @unlink($zipFn);
        $this->assertFileDoesNotExist($zipFn);

        $exitCode = $this->withoutMockingConsoleOutput()
            ->artisan('crud:remove', ['tables' => (array) 'tickets', '--backup' => $zipFn]);
        $result = Artisan::output();
        $this->assertStringContainsString('Removing file', $result);
        $this->assertStringContainsString('Backup created', $result);
        $this->assertEquals(0, $exitCode);
        $this->assertFileDoesNotExist(app_path('Http/Controllers/TicketController.php'));
        $this->assertFileExists($zipFn);
    }
}

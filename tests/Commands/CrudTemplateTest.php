<?php

namespace San\Crud\Tests\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use San\Crud\Tests\TestCase;

class CrudTemplateTest extends TestCase {
    public function testHandle() {
        $base = base_path('templates');
        $dest = sprintf('%s/%s', $base, 'crud');

        if (is_dir($dest)) {
            File::deleteDirectory($dest);
        }

        $this->assertDirectoryDoesNotExist($dest);

        $exitCode = $this->withoutMockingConsoleOutput()
            ->artisan('crud:template', ['name' => 'crud']);
        $result = Artisan::output();
        $this->assertEquals(0, $exitCode);
        $this->assertMatchesRegularExpression('/Created \d+ files/', $result);
    }
}

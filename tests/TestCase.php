<?php

namespace San\Crud\Tests;

use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as Orchestra;
use San\Crud\Commands\CrudGenerate;
use San\Crud\ServiceProvider;
use Spatie\TranslationLoader\TranslationServiceProvider;
use Symfony\Component\Console\Output\BufferedOutput;

abstract class TestCase extends Orchestra {

    protected $template_dir;

    public function setUp(): void {
        parent::setUp();
        $templateDir = __DIR__ . '/../src/template';
        $this->template_dir = realpath($templateDir);
        $this->assertDirectoryExists($this->template_dir);

        Artisan::call('migrate');

        foreach (['users', 'leads', 'replies', 'tickets'] as $table) {
            $migration = require __DIR__ . "/../database/migrations/{$table}_table.php";
            $migration->up();
        }
    }

    protected function getPackageProviders($app) {
        return [
            ServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app) {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function inlineCommand(array $args = [], $run = FALSE) {
        $command = new CrudGenerate();
        $input = new \Symfony\Component\Console\Input\ArrayInput($args);
        $input->bind($command->getDefinition());

        $stdout = new BufferedOutput(BufferedOutput::VERBOSITY_VERY_VERBOSE);

        $command->setInput($input);
        $command->setOutput(new OutputStyle($input, $stdout));

        if ($run) {
            $command->handle();
        }

        echo $stdout->fetch();

        return $command;
    }
}

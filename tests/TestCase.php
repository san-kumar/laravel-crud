<?php

namespace San\Crud\Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Illuminate\Console\OutputStyle;
use Illuminate\Foundation\Testing\Concerns\InteractsWithConsole;
use Illuminate\View\Factory;
use San\Crud\Commands\MakeCrud;
use San\Crud\ServiceProvider;
use Symfony\Component\Console\Output\BufferedOutput;

abstract class TestCase extends AbstractPackageTestCase {
    protected function inlineCommand(array $args = [], $run = FALSE) {
        $command = new MakeCrud();
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

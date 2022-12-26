<?php

namespace San\Crud\Commands;

use Illuminate\Console\Command;
use San\Crud\Generators\ControllerGen;
use San\Crud\Generators\ModelGen;
use San\Crud\Generators\PolicyGen;
use San\Crud\Generators\RouteGen;
use San\Crud\Generators\Templates;
use San\Crud\Generators\ViewGen;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CrudRemove extends CrudBase {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'crud:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the generated CRUD files for table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $tables = $this->getTables();

        $cgen = new ControllerGen($tables, $tables);
        $mgen = new ModelGen($tables, $tables);
        $rgen = new RouteGen($tables, $tables);
        $vgen = new ViewGen($tables, $tables);
        $pgen = new PolicyGen($tables, $tables);

        $blanks = [
            'controller' => $cgen->getControllerName(),
            'model'      => $mgen->getModelName(),
            'route'      => $rgen->getRouteName(),
            'policy'     => $pgen->getPolicyName(),
        ];

        $files = new Templates($this->getTemplateDir());
        $cssFramework = 'bootstrap';
        $interactive = $this->option('interactive');

        if ($zipFile = $this->option('backup')) {
            if (!class_exists('ZipArchive')) {
                $this->error('ZipArchive class not found. Please install php-zip extension.');
                return COMMAND::FAILURE;
            }

            $zip = new \ZipArchive();
            $result = $zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            if (($result !== TRUE) || !is_writable(dirname($zipFile))) {
                $this->error('Cannot create zip file: ' . $zipFile);
                return COMMAND::FAILURE;
            }
        }

        foreach ($this->getStubTypes($cssFramework) as $type) {
            $stubs = $files->getStubs($type);

            foreach ($stubs as $stub) {
                $dest = $files->getDest($type, $stub, $blanks, $rgen->getRouteUrl());

                if (file_exists($dest)) {
                    if ($interactive && !$this->confirm("Delete $dest?")) {
                        continue;
                    }

                    if (!empty($zip)) {
                        $zip->addFromString(file_get_contents($dest), sprintf('%s/%s', $type, basename($dest)));
                    }

                    $this->info("Removing file $dest");

                    unlink($dest);
                }
            }
        }

        if (!empty($zip) && ($zip->numFiles > 0)) {
            $zip->close();
            $this->info(sprintf("Backup created at: %s", realpath($zipFile)));
        }

        return Command::SUCCESS;
    }

    protected function getOptions() {
        return [
            ['backup', 'b', InputOption::VALUE_REQUIRED, 'Name of zip file to backup files before removing'],
            ['interactive', 'i', InputOption::VALUE_NONE, 'Ask for confirmation before removing each file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getArguments() {
        return [
            ['table', InputArgument::REQUIRED, 'Remove all generated files for the given tables'],
        ];
    }
}

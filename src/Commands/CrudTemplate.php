<?php

namespace San\Crud\Commands;

use Illuminate\Console\Command;
use San\Crud\Utils\FileUtils;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CrudTemplate extends CrudBase {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'crud:template';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new template for CRUD generation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $base = base_path($this->option('output') ?: 'templates');
        $dest = sprintf('%s/%s', $base, $this->argument('name'));
        $force = $this->option('force');

        if (is_dir($dest) && !$force) {
            $this->error("Template '$dest' already exists");
            return Command::FAILURE;
        }

        $src = realpath(__DIR__ . '/../template');
        if (!is_dir($src)) {
            $this->error("Template source '$src' not found");
            return Command::FAILURE;
        }

        $count = FileUtils::recursiveCopy($src, $dest, $force);
        $this->info("Created $count files in '$dest'");

        return Command::SUCCESS;
    }

    protected function getOptions() {
        return [
            ['output', 'o', InputOption::VALUE_REQUIRED, 'Output directory name (default: "templates")'],
            ['force', 'f', InputOption::VALUE_NONE, 'Overwrite existing files'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getArguments() {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the new template'],
        ];
    }
}

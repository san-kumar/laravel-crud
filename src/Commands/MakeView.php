<?php

namespace San\Crud\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeCrud extends Command {
    /**
     * {@inheritdoc}
     */
    protected $name = 'make:crud';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Create a new CRUD';

    /**
     * Execute the command.
     */
    public function handle() {

    }
}

<?php

namespace San\Crud\Commands;

use Illuminate\Console\Command;
use San\Crud\Formatters\Formatter;
use San\Crud\Generators\ControllerGen;
use San\Crud\Generators\ModelGen;
use San\Crud\Generators\PolicyGen;
use San\Crud\Generators\RouteGen;
use San\Crud\Generators\Templates;
use San\Crud\Generators\ViewGen;
use San\Crud\Utils\FileUtils;
use San\Crud\Utils\SchemaUtils;
use San\Crud\Utils\TextUtils;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CrudGenerate extends CrudBase {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'crud:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a CRUD for a given database table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $tables = $this->getTables();
        $aliases = $this->getTableAliases();

        $routePrefix = $this->option('prefix');

        $cgen = new ControllerGen($tables, $aliases);
        $mgen = new ModelGen($tables, $aliases);
        $rgen = new RouteGen($tables, $aliases, $routePrefix);
        $vgen = new ViewGen($tables, $aliases, $routePrefix);
        $pgen = new PolicyGen($tables, $aliases);

        $blanks = [
            'var'    => $cgen->getVarName(),
            'vars'   => $cgen->getVarNamePlural(),
            'title'  => $cgen->getTitle(),
            'titles' => $cgen->getTitlePlural(),

            'controller' => $cgen->getControllerName(),
            'cquery'     => $cgen->getQuery(),
            'cfindbyid'  => $cgen->getFindById(),
            'cwith'      => $cgen->getWith(),
            'csearch'    => $cgen->getSearch(),
            'cpager'     => $cgen->getPager(),

            'cparentargs' => $cgen->getControllerParentArgs(),
            'callargs'    => $cgen->getControllerAllArgs(),

            'cselects'    => $cgen->getSelects(),
            'cindexvars'  => $cgen->getIndexVars(),
            'callvars'    => $cgen->getAllVars(),
            'cparentvars' => $cgen->getParentVars(),
            'ccreatevars' => $cgen->getCreateVars(),
            'ceditvars'   => $cgen->getEditVars(),

            'cvalidatecreate' => $cgen->getValidations(FALSE),
            'cvalidateedit'   => $cgen->getValidations(TRUE),
            'cstore'          => $cgen->getStore(FALSE),
            'cedit'           => $cgen->getStore(TRUE),

            'model'      => $mgen->getModelName(),
            'usesmodels' => $mgen->getUsesModels(),
            'softdelete' => $mgen->getSoftDelete(),
            'fillable'   => $mgen->getFillable(),
            'belongsto'  => $mgen->getBelongsTo(),
            'hasmany'    => $mgen->getHasMany(),
            'casts'      => $mgen->getCasts(),
            'tablename'  => $mgen->mainTableReal(),

            'route'                  => $rgen->getRouteName(),
            'routevars'              => $rgen->getRouteVars(),
            'routevarswithid'        => $rgen->getRouteVarsWithId(),
            'routeurl'               => $rgen->getRouteUrl(),
            'parentrouteurl'         => $rgen->getParentRouteUrl(),
            'routeurlwithvars'       => $rgen->getRouteUrlWithPlaceholders(),
            'routeurlwithid'         => $rgen->getRouteUrlWithId(),
            'parentrouteurlwithvars' => $rgen->getParentRouteUrlWithPlaceholders(),

            'asroute' => $rgen->getAsRoute(),

            'policy'           => $pgen->getPolicyName(),
            'cpolicy'          => $pgen->getControllerPolicy(),
            'policyreadargs'   => $pgen->getPolicyReadArgs(),
            'policyreadrules'  => $pgen->getPolicyReadRules(),
            'policywriteargs'  => $pgen->getPolicyWriteArgs(),
            'policywriterules' => $pgen->getPolicyWriteRules(),

            'view' => $vgen->getViewName(),

            'authorize'  => $pgen->getControllerPolicy(),
            'pauthorize' => $pgen->getParentAuthorization(),
            'mauthorize' => $pgen->getModelAuthorization(),

            'layout'  => sprintf('layouts.%s', $this->option('layout') ?: 'app'),
            'section' => $this->option('section') ?: 'content',
        ];

        $files = new Templates($this->getTemplateDir());
        $indexView = preg_match('/^(cards|chat)$/', $this->option('index')) ? $this->option('index') : 'table';

        $cssFramework = $this->getCssFramework();
        $partialsDir = "{$files->templatePath()}/stubs/views/$cssFramework/partials";

        $blanks['breadcrumbs'] = $vgen->getBreadcrumbs('render/breadcrumbs', $partialsDir);
        $blanks['index'] = $vgen->genIndex("render/$indexView", $partialsDir, $blanks);
        $blanks['create'] = $vgen->genForm('render/form', $partialsDir, $blanks, FALSE);
        $blanks['edit'] = $vgen->genForm('render/form', $partialsDir, $blanks, TRUE);
        $blanks['show'] = $vgen->genIndex('render/show', $partialsDir, $blanks);

        $formatter = new Formatter($tables, $aliases);
        $forceOverwrite = $this->option('force');

        foreach ($this->getStubTypes($cssFramework) as $type) {
            $stubs = $files->getStubs($type);

            foreach ($stubs as $stub) {
                $str = TextUtils::replaceBlanks(file_get_contents($stub), $blanks);
                $str = $formatter->fixSoftDelete($str);

                $dest = $files->getDest($type, $stub, $blanks, $rgen->getRouteUrlWithoutPrefix());

                if ($forceOverwrite || !file_exists($dest)) {
                    $this->info("Writing $dest");
                    FileUtils::writeFile($dest, $str);
                } else {
                    $this->warn("File already exists (skipping):\n$dest");
                }
            }
        }

        return Command::SUCCESS;
    }

    protected function getOptions() {
        return [
            ['css', 'c', InputOption::VALUE_REQUIRED, 'Which css framework to use: bootstrap or tailwind (default: bootstrap)'],
            ['prefix', 'p', InputOption::VALUE_REQUIRED, 'The prefix for the route name (default: none)'],
            ['index', 'i', InputOption::VALUE_REQUIRED, 'The index view to use: "table", "cards" or "chat" (default table)'],
            ['layout', 'l', InputOption::VALUE_REQUIRED, 'The @layout name used by the views (default "app")'],
            ['section', 's', InputOption::VALUE_REQUIRED, 'The @section name used by the views (default "content")'],
            ['tailwind', 't', InputOption::VALUE_NONE, 'Use Tailwind CSS instead of Bootstrap 5 (shorthand for --css=tailwind)'],
            ['template', 'd', InputOption::VALUE_REQUIRED, 'The template directory (if you want to use custom templates)'],
            ['alias', 'a', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'The alias for the table name (e.g. --alias some_alias=table_name --alias some_other_alias=another_table)'],
            ['force', 'f', InputOption::VALUE_NONE, 'Force overwriting of existing files'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getArguments() {
        return [
            ['table', InputArgument::REQUIRED, 'The name of the table (with parent tables separated by a dot)'],
        ];
    }
}

<?php

namespace San\Crud;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {
    /**
     * {@inheritdoc}
     */
    public function register() {
        $this->commands([
            Commands\CrudGenerate::class,
            Commands\CrudRemove::class,
            Commands\CrudTemplate::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function boot() {
        $this->publishes([
            __DIR__ . '/../config/crud.php' => config_path('crud.php'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function provides() {
        return [
            Commands\CrudGenerate::class,
            Commands\CrudRemove::class,
            Commands\CrudTemplate::class,
        ];
    }
}

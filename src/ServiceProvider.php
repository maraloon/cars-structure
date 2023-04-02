<?php

namespace Avangard\CarsStructure;

use Avangard\CarsStructure\Command\CopyCarModels;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use function config_path;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cars_colors.php', 'cars_colors');
        $this->mergeConfigFrom(__DIR__ . '/../config/cars_structure.php', 'cars_structure');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/cars_colors.php' => config_path('cars_colors.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../config/cars_structure.php' => config_path('cars_structure.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CopyCarModels::class,
            ]);
        }
    }
}

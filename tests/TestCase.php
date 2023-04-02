<?php

namespace Tests;

use Avangard\CarsStructure\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Services\CarsEloquentService;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected $database = 'testbench';

    protected function setUp(): void
    {
        parent::setUp();

        $this->migrate();
    }

    protected function getEnvironmentSetUp($app)
    {
        $this->setDatabase($app);
    }

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton(Kernel::class, HttpKernel::class);
    }

    protected function service()
    {
        return CarsEloquentService::make();
    }

    private function setDatabase($app)
    {
        $app['config']->set('database.default', $this->database);

        $app['config']->set('database.connections.' . $this->database, [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    private function migrate()
    {
        $this->loadLaravelMigrations($this->database);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->refreshDatabase();
    }
}

<?php

namespace Tests\Feature;

use App\Models\Cars\Car;
use Illuminate\Filesystem\Filesystem;
use SplFileInfo;
use Tests\TestCase;

class CarsCommandTest extends TestCase
{
    public function testCopyCarsModels()
    {
        $config_file     = config_path('cars_structure.php');
        $model_directory = app_path('Models/Cars');

        $this->artisan('cars:models:copy');

        set_include_path($model_directory);
        $this->splLoad($this->filesystem()->allFiles($model_directory));

        $this->assertEquals(class_exists(Car::class), true);
        $this->assertFileExists($config_file);
        $this->assertDirectoryExists($model_directory);
    }

    protected function splLoad($files)
    {
        $files->each(function (SplFileInfo $item) {
            require $item->getPathname();
        });

    }

    protected function filesystem(): Filesystem
    {
        return new Filesystem();
    }
}

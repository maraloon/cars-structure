<?php


namespace Avangard\CarsStructure\Command;


use Avangard\CarsStructure\Contracts\Published;
use Avangard\CarsStructure\ServiceProvider;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

class CopyCarModels extends Command
{
    protected $signature = 'cars:models:copy';

    protected $description = 'Command description';

    protected string $directory = 'Models';

    protected Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        parent::__construct();
    }

    public function handle(): void
    {
        $this->info('Publishing the config files');
        $this->call('vendor:publish', ['--provider' => ServiceProvider::class]);

        $this->getModels()
            ->each(function ($model) {

                $project_model = $this->getProjectModel($model);

                if (class_exists($project_model)){
                    $this->warn('Model "' . $project_model . '" exist');
                    return;
                }

                $this->copyModel($model, $project_model);
                $this->changeConfig($model, $project_model);

                $this->info('Model "' . $project_model . '" was copied');

            });

        $this->info('Complete');
    }

    protected function getModels(): Collection
    {
        return collect($this->filesystem->allFiles(__DIR__ . '/../' . $this->directory))
            ->map(fn(SplFileInfo $model)
                => $this->getComposerNamespace() . '\\' . $this->directory . '\\' . $model->getFilenameWithoutExtension())
            ->map(fn($class) => $class instanceof Published ? $class : null)
            ->filter()
            ->values();
    }

    protected function getComposerNamespace(): string
    {
        $composer = json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true);
        $psr      = Arr::get($composer, 'autoload.psr-4');

        return trim(key($psr), '\\');
    }

    protected function getProjectNamespace(): string
    {
        return implode('\\', [trim(app()->getNamespace(), '\\'), $this->directory, 'Cars']);
    }

    protected function getProjectModel($model): string
    {
        $class = str_replace('Cars', '', class_basename($model));

        return $this->getProjectNamespace() . '\\' . $class;
    }

    protected function makeModelsDir($directory): void
    {
        if ($this->filesystem->missing($directory)) {
            $this->filesystem->makeDirectory($directory);
        }
    }

    protected function copyModel($from, $to): void
    {
        $class_name = class_basename($to);
        $directory = app_path($this->directory . '/Cars');
        $stub       = $this->filesystem->exists($path = $this->stubPath('Model.php.stub'))
            ? $this->filesystem->get($path)
            : null;

        if (is_null($stub)) {
            throw new Exception('stub not exist');
        }
        $this->makeModelsDir($directory);

        $this->filesystem->put(
            $directory . '/' . $class_name . '.php', $this->populateStub($stub, $class_name, $from)
        );
    }

    protected function changeConfig($from, $to): void
    {
        $path = config_path('cars_structure.php');

        if (!$this->filesystem->exists($path)) {
            throw new Exception('config not exist');
        }

        $changedConfig = str_replace(
            [
                $from . ';',
                class_basename($from) . '::class',
            ],
            [
                $to . ';',
                class_basename($to) . '::class',
            ],
            $this->filesystem->get($path));

        $this->filesystem->put($path, $changedConfig);
    }

    protected function stubPath($filename): string
    {
        return __DIR__ . '/../../stubs/' . $filename;
    }

    protected function populateStub($stub, $class, $base_model)
    {
        $base_name = class_basename($base_model);

        return str_replace(
            ['{{ class }}', '{{ base_model }}', '{{ namespace }}', '{{ model_name }}'],
            [
                $class,
                $base_name === $class ? $base_model . ' as Base' . $class : $base_model,
                $this->getProjectNamespace(),
                $base_name === $class ? 'Base' . $class : $base_name,
            ],
            $stub);
    }
}

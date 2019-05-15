<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RepositoryGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The name of the migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create custom repository pattern';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->repository($name);
        $this->repositoryInterface($name);
        $this->controller($name);

        File::append(\base_path('routes/api.php'), $this->appendRoutes($name));
    }

    public function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function repository($name)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameLowerCase}}'
            ],
            [
                $name,
                lcfirst($name)
            ],
            $this->getStub('Repository')
        );
        file_put_contents(app_path("/Repositories/{$name}Repository.php"), $modelTemplate);
    }

    protected function repositoryInterface($name)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameLowerCase}}'
            ],
            [
                $name,
                lcfirst($name)
            ],
            $this->getStub('RepositoryInterface')
        );
        file_put_contents(app_path("/Repositories/{$name}RepositoryInterface.php"), $modelTemplate);
    }

    protected function controller($name)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameLowerCase}}',
                '{{modelNamePluralLowerCase}}'
            ],
            [
                $name,
                lcfirst($name),
                lcfirst(str_plural($name))
            ],
            $this->getStub('Controller')
        );
        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $modelTemplate);
    }

    protected function appendRoutes($name) {
        $lowerName = lcfirst($name);

        $route = "Route::group(['prefix' => ''], function () {";
        $route = $route."\n\tRoute::get('', '{$name}Controller@getAllBrand');";
        $route = $route."\n\tRoute::get('{{$lowerName}}_id}', '{$name}Controller@getBrandById');";
        $route = $route."\n\tRoute::post('', '{$name}Controller@createBrand');";
        $route = $route."\n\tRoute::put('{{$lowerName}_id}', '{$name}Controller@updateBrandById');";
        $route = $route."\n\tRoute::delete('{{$lowerName}_id', '{$name}Controller@deleteBrandById');";
        $route = $route."\n});";

        return $route;
    }
}

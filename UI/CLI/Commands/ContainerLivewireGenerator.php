<?php

namespace App\Containers\Vendor\Livewire\UI\CLI\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use App\Containers\Vendor\Livewire\Generators\ExtendedGeneratorCommand;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ContainerLivewireGenerator extends ExtendedGeneratorCommand implements ComponentsGenerator
{



    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     */
    public array $inputs = [
        [
            'component_name', null, InputOption::VALUE_OPTIONAL, 'The Component Name',
        ],
        [
            'url', null, InputOption::VALUE_OPTIONAL, 'The base URI of all endpoints (/stores, /cars, ...)',
        ],
        [
            '$doctype', null, InputOption::VALUE_OPTIONAL, 'Select the type for this endpoint , [private, public]',

        ]
    ];
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:container:livewire';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Livewire Container for apiato from scratch (Livewire Part)';
    /**
     * The type of class being generated.
     */
    protected string $fileType = 'Container';
    /**
     * The structure of the file path.
     */
    protected string $pathStructure = '{section-name}/{container-name}/*';
    /**
     * The structure of the file name.
     */
    protected string $nameStructure = '{file-name}';
    /**
     * The name of the stub file.
     */
    protected string $stubName = 'composer.stub';

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $component_name = $this->checkParameterOrAsk('component_name', 'Enter the name of the Component', '');

        $ui = 'web';



        // container name as inputted and lower
        $containerName = $this->containerName;
        $_containerName = Str::lower($this->containerName);

        // name of the model (singular and plural)
        $model = $this->containerName;
        $models = Pluralizer::plural($model);

        // add the Livewire  file
        $this->printInfoMessage('Generating Livewire Component');
        $this->call('livewire:make', ['name' => $_containerName . '.' . Str::lower($component_name),
            '--quite'
        ]);



        // add the View file
        $this->printInfoMessage('Generating View File');
        //Empty the Views Temp Folder that Livewire Created, and replace with Apiato View
        $this->clearOldViews();
        $this->call('apiato:generate:view', [
            '--section' => 'Livewire',
            '--container' => Str::snake($containerName),
            '--file' => Str::lower($component_name),
        ]);

        // create the configuration file
        $this->printInfoMessage('Generating Configuration File');
        $this->call('apiato:generate:configuration', [
            '--section' => 'Livewire',
            '--container' => $containerName,
            '--file' => Str::camel($this->sectionName) . '-' . Str::camel($this->containerName),
        ]);

        // create the MainServiceProvider for the container
        $this->printInfoMessage('Generating MainServiceProvider');
        $this->call('apiato:generate:serviceprovider', [
            '--section' => 'Livewire',
            '--container' => $containerName,
            '--file' => 'MainServiceProvider',
            '--stub' => 'livewireserviceprovider',
        ]);

        // create the default routes for this container
        $this->printInfoMessage('Generating Default Routes');
        $version = 1;
         $doctype = 'private';
      //  $doctype = $this->checkParameterOrChoice('doctype', 'Select the type for this endpoint', ['private', 'public'], 0);
        $url = Str::lower($this->checkParameterOrAsk('url', 'Enter the base URI for *all* WEB endpoints (' . Str::lower($containerName) . '/' . Str::lower($component_name) . ')', Str::slug($containerName) . '/' . Str::slug($component_name)));
        $url = ltrim($url, '/');

        $this->printInfoMessage('Creating Livewire Route File');


        $routes = [
            [

                'name' => Str::lower($component_name),
                'verb' => 'GET',
                'url' => $url,

            ],

        ];


        $this->call('apiato:generate:livewire-route', [

            '--section' => 'Livewire',
            '--container' => $containerName,
            '--file' => str_replace(  '.', '-'  ,$component_name),
            '--ui' => $ui,
            '--operation' =>$component_name,
            '--doctype' => $doctype,
            '--docversion' => $version,
            '--url' => $url,
            '--verb' => 'GET',
        ]);


        $this->printInfoMessage('All Done  you have to change the path to your view to: livewire@' . strtolower($containerName) . '::' . strtolower($component_name));
    }

    /**
     * Get the default file name for this component to be generated
     */
    public function getDefaultFileName(): string
    {
        return 'composer';
    }

    public function getDefaultFileExtension(): string
    {
        return 'json';
    }

    private function clearOldViews()
    {

        if (File::exists(config('livewire.view_path'))) {
            File::cleanDirectory(config('livewire.view_path'));
        }


    }
}

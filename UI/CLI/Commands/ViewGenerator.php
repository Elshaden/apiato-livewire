<?php

namespace App\Containers\Vendor\Livewire\UI\CLI\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use App\Containers\Vendor\Livewire\Generators\ExtendedGeneratorCommand;
use Illuminate\Support\Str;

class ViewGenerator extends ExtendedGeneratorCommand implements ComponentsGenerator
{
    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
    ];
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:view';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a View file for a Container';
    /**
     * The type of class being generated.
     */
    protected string $fileType = 'View';
    /**
     * The structure of the file path.
     */
    protected string $pathStructure = '{section-name}/{container-name}/UI/WEB/Views/{file-name}';
    /**
     * The structure of the file name.
     */
    protected string $nameStructure = '{file-name}';
    /**
     * The name of the stub file.
     */
    protected string $stubName = 'customview.stub';

    /**
     * @return array
     */
    public function getUserInputs()
    {
        return [
            'path-parameters' => [
                'section-name' => $this->sectionName,
                'container-name' => $this->containerName,
                'file-name'=>$this->fileName,
            ],
            'stub-parameters' => [
                '_section-name' => Str::lower($this->sectionName),
                'section-name' => $this->sectionName,
                '_container-name' => Str::lower($this->containerName),
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

    /**
     * Get the default file name for this component to be generated
     */
    public function getDefaultFileName(): string
    {
        return 'view';
    }

    public function getDefaultFileExtension(): string
    {
        return 'blade.php';
    }
}

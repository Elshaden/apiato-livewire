<?php

namespace App\Containers\Vendor\Livewire\Generators;

use Apiato\Core\Exceptions\GeneratorErrorException;
use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;

class ExtendedGeneratorCommand extends GeneratorCommand
{

    protected $fileSystem    ;
   public function __construct(IlluminateFilesystem $fileSystem)
   {
       parent::__construct($fileSystem);
   }
    //  private IlluminateFilesystem $fileSystem;

      /**
     * Default section name
     *
     * @var string
     */
    public const DEFAULT_SECTION_NAME = 'Livewire';

    /**
     * @void
     *
     * @throws GeneratorErrorException|FileNotFoundException
     */
    public function handle()
    {
        $this->validateGenerator($this);

        $this->sectionName = ucfirst($this->checkParameterOrAsk('section', 'Enter the name of the Section', self::DEFAULT_SECTION_NAME));
        $this->containerName = ucfirst($this->checkParameterOrAsk('container', 'Enter the name of the Container'));
        $this->fileName = $this->checkParameterOrAsk('file', 'Enter the name of the ' . $this->fileType . ' file', $this->getDefaultFileName());

        // Now fix the section, container and file name
        $this->sectionName = $this->removeSpecialChars($this->sectionName);
        $this->containerName = $this->removeSpecialChars($this->containerName);
        if (!$this->fileType === 'Configuration')
            $this->fileName = $this->removeSpecialChars($this->fileName);

        // And we are ready to start
        $this->printStartedMessage($this->sectionName . ':' . $this->containerName, $this->fileName);

        // Get user inputs
        $this->userData = $this->getUserInputs();

        if ($this->userData === null) {
            // The user skipped this step
            return;
        }
        $this->userData = $this->sanitizeUserData($this->userData);

        // Get the actual path of the output file as well as the correct filename
        $this->parsedFileName = $this->parseFileStructure($this->nameStructure, $this->userData['file-parameters']);
        $this->filePath = $this->getFilePath($this->parsePathStructure($this->pathStructure, $this->userData['path-parameters']));

        if (!$this->fileSystem->exists($this->filePath)) {
            // Prepare stub content
            $this->stubContent = $this->getStubContent();
            $this->renderedStubContent = $this->parseStubContent($this->stubContent, $this->userData['stub-parameters']);

            $this->generateFile($this->filePath, $this->renderedStubContent);

            $this->printFinishedMessage($this->fileType);
        }

        // Exit the command successfully
        return 0;
    }

    /**
     * @param $generator
     *
     * @throws GeneratorErrorException
     */
    private function validateGenerator($generator): void
    {
        if (!$generator instanceof ComponentsGenerator) {
            throw new GeneratorErrorException(
                'Your component maker command should implement ComponentsGenerator interface.'
            );
        }
    }
}

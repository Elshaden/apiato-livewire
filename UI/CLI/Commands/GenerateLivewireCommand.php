<?php

namespace App\Containers\Vendor\Livewire\UI\CLI\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use App\Containers\AppSection\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\Vendor\Livewire\Generators\ContainerLivewireGenerator;
use App\Containers\Vendor\Livewire\Generators\ExtendedGeneratorCommand;
use App\Ship\Parents\Commands\ConsoleCommand;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class GenerateLivewireCommand  extends \Apiato\Core\Abstracts\Commands\ConsoleCommand
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiato:generate:livewire {component}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Livewire Component';

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
     * @return int
     */
    public function handle()
    {

        $container = $this->ask('What is Container Name In Livewire Section?');


        return Command::SUCCESS;
    }

}

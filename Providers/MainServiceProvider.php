<?php

namespace App\Containers\Vendor\Livewire\Providers;

use App\Containers\Vendor\Debugger\Tasks\QueryDebuggerTask;
use App\Ship\Parents\Providers\MainProvider;
use Jenssegers\Agent\AgentServiceProvider;
use Jenssegers\Agent\Facades\Agent;
use App\Containers\Vendor\Livewire\Providers\LivewireViewsProvider;
use Illuminate\Support\Facades\Blade;
/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        AgentServiceProvider::class,
        MiddlewareServiceProvider::class,

    ];

    public function boot() :void
      {

        parent::boot() ;
        Blade::component('vendor@livewire::components.lw-master', 'livewire-master');

     //    LivewireViewsProvider::class;

      }
    /**
     * Container Aliases
     */
    public array $aliases = [
        'Agent' => Agent::class
    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();
            app(QueryDebuggerTask::class)->run();
    }
}

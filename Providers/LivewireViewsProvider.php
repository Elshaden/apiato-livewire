<?php

namespace App\Containers\Vendor\Livewire\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LivewireViewsProvider
{
    public function boot() :void
    {

        Blade::component('livewire@folder::components.master', 'master');



    }
}

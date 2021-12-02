
# [Apiato](https://github.com/apiato/apiato) Livewire Container
# Laravel  [Livewire](https://laravel-livewire.com/)


#### This Apiato container provides a simple and easy way to add Livewire to Views.

#### Github https://github.com/Elshaden/apiato-livewire.git
   

### Why would anyone use an API  Backend  for a Frontend application?
Well, if you are familiar with Apiato, you would know that Apiato uses the DDD pattern, Domain Driven Design,
this will make your code very well organized, easily maintainable, and most important,
simple to have many developers work on the same application.
While, the makers of Apiato, insist that it is mainly focused on API backend, I disagree, Apiato can handle both Web application as a frontend, and at the same time 
deliver flawless API backend.

_Don't take my word for it..  Go on and give a test run..._

#Usage

In Existing Apiato Application
```  
composer require elshaden/apiato-livewire 

```  


#### Once Installed via Composer Require  to install the container in Apiato Application
#### [Apiato Container Installer](http://apiato.io/docs/getting-started/container-installer)  for more details

#### To Create a new Livewire Component   V4
#### V4 uses an Apiato Generator, which will make all necessary boilerplate.

`
php artisan apiato:generate:container:livewire
`

#### you will be prompted to enter the Details of the Component
- for Section enter Livewire or just enter, the system will create under the Livewire section regardless.
- for File name just click enter leave as is
- for the Container  Enter the name of the Container, Not to be confused with the Component, this is just like any other Apiato Container
- the Component , that is your desired Livewire Component , you can use dots to define subfolders within the same Container


#### This will create a new section called  Livewire
- app
- Containers
- AppSection
- **Livewire**
  - Configs
  - Providers
  - UI
    - WEB
    - Routes
    - Views
  - <LivewireComponent1 / Or Livewire Component Dir1 >
  - <LivewireComponent2 / Or Livewire Component Dir2 >

- Vendor
- ...
- Livewire
- ...
  `

#### usual Livewire Class and View will be created in these folders

### You must change  the render method in the Livewire Component Class

```  
 public function render() {  
		 return view('livewire@<ContainerName>::component');  
 }
 ```  


### Views
The View Must Extend layouts.app   
`@extends('vendor@livewire::layouts.app')`

In this view you must call the related Livewrie Component in the @section('content')   
```
@section('content')

<div>
@livewire('<component name>') 
</div>
@endsection

```

### Blade Components
You can Create your own Blade Component and use them in the views
you have to register all of them in the Main service provider in the container.

The same can be done with Livewire UI Modal, which is added by default  
for more Details on Livewire UI Modal visit  https://github.com/livewire-ui/modal

#### Now you can use Livewire as Web frontend with Livewire, and all the classes of Apiato at your disposal.



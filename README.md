# [Apiato](https://github.com/apiato/apiato) Livewire Container
# Laravel  [Livewire](https://laravel-livewire.com/)


#### This Apiato container provides a simple and easy way toAdd Livewire to Views.

#### Github https://github.com/Elshaden/apiato-livewire.git

#Usage

 In Existing Apiato Application
```
   composer require elshaden/apiato-livewire

```

#### Once Installed via Composer Require  to install the container in Apiato Application
#### [Apiato Conatainer Installer](http://apiato.io/docs/getting-started/container-installer)  for more details

#### Run your normal  Livewire command to create new Component

#### Ideally it should conform to your Apiato File Structure for example the user component should be called  user.user


`
php artisan livewire:make <component name>
`

#### This will create a Folder in the AppSection called  Livewire
#### usual Livewire Class and View will be created in this folder

### You must change  the render method in the Livewire Component Class   from

```
    public function render()
    {

             return view('livewire.<component name>');

    }
```
### To

```
    public function render()
    {
            return view(config('livewire.view').'<component name>');
    }
```
      

#### To integrate with Apiato Controller
  In the controller you must create a method call it Livewire or anything you want  which you call from related route

 the method returns normal Apiato view from the container/UI/WEB/Views.

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


You now can call any Apiato Method from Livewire Component and have the view render the data as you wish.  

The same can be done with Livewire UI Modal, which is added be default
for more Details on Livewire UI Modal visit  https://github.com/livewire-ui/modal
   
   
    








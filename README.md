# [Apiato](https://github.com/apiato/apiato) Livewire Container

#### This Apiato container provides a simple and easy way toAdd Livewire to Views.

### Github https://github.com/Elshaden/apiato-livewire.git
#Usage

#### Once Installed via Composer Require

#### run your normal  Livewire command to create new Component

#### Ideally it should conform to your Apiato File Structure for example the user component should be called  user.user


`
php artisan livewire:make <component name>
`

#### This will create a Folder in the AppSection called  Livewire
#### usual Livewire Class and View will be created in this folder

### You must go  the Livewire Component Class  and change the render method from

`
    public function render()
    {
    return view('livewire.<component name>');
    }`

### To

`
    public function render()
    {
    return view(config('livewire.view').'<component name>');
    }
`
      

#### To integrate with Apiato Controller
  In the controller you must create a method call it Livewire or anything you want

 the method returns normal Apiato view from the container.

 The View Must Extend layouts.app 
 `@extends('vendor@livewire::layouts.app')`

 In this view you must call the related Livewrie Component in the @section('content') 
 ```
  @section('content')
      <div>
           @livewire('<component name>')
       </div>
 @endsection
> ```


 You now can call any Apiato Method from Livewire and have the view render the data as you wish.  
   
   
    








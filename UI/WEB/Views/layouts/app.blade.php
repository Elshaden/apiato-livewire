<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @stack('styles')
        <!-- Styles -->

            @livewireStyles
        </head>

        <body class="font-body antialiased ">
        @yield('content')


        @livewire('livewire-ui-modal')
        @livewireScripts

        @stack('scripts')

</body>
</html>


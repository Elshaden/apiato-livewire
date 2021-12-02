@extends('vendor@livewire::layouts.app')

@push('styles')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

@endpush

@section('content')
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-50">

{{$navigation??''}}

<!-- Page Heading -->


    <!-- Page Content -->
    <main>
        <div class="py-5 max-w-7xl mx-auto font-arabic">

        {{ $slot }}
        </div>
    </main>
</div>
@endsection




{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- The title will be dynamic for SEO --}}
    {!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- This is the Vite directive that will load our compiled CSS and JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-sans bg-white text-gray-900 antialiased">
    <div class="min-h-screen bg-gray-50">
        {{-- We will include our navigation bar here --}}
        @include('layouts.partials.navigation')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        {{-- We will include our footer here --}}
        @include('layouts.partials.footer')
    </div>
</body>
</html>

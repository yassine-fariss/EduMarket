@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($title ?? 'Accueil') }} — {{ config('app.name', 'EduMarket') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        @include('layouts.customer-nav')

        <x-flash-messages />

        @isset($header)
            <header class="bg-white border-bottom">
                <div class="container py-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="flex-grow-1">
            <div class="container py-4">
                {{ $slot }}
            </div>
        </main>

        <x-footer />
    </div>

    @stack('scripts')
</body>
</html>

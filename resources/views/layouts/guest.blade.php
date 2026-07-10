@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($title ?? 'Connexion') }} — {{ config('app.name', 'EduMarket') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="d-flex flex-column min-vh-100">
        @include('layouts.customer-nav')

        <x-flash-messages />

        <main class="flex-grow-1 d-flex align-items-center py-4 auth-page">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="auth-card">
                            <div class="card-body p-4 p-lg-5">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <x-footer />
    </div>

    @stack('scripts')
</body>
</html>

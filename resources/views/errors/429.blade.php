<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EduMarket') }} - 429</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1 class="display-1 fw-bold text-secondary">429</h1>
        <h4 class="mb-3">{{ __('Trop de requêtes') }}</h4>
        <p class="text-muted mb-4">{{ __('Vous avez effectué trop de requêtes. Veuillez réessayer plus tard.') }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Retour à l\'accueil') }}</a>
    </div>
</body>
</html>

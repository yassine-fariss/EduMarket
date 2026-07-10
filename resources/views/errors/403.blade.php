<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EduMarket') }} - 403</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1 class="display-1 fw-bold text-danger">403</h1>
        <h4 class="mb-3">{{ __('Accès interdit') }}</h4>
        <p class="text-muted mb-4">{{ __('Vous n\'avez pas la permission d\'accéder à cette page.') }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Retour à l\'accueil') }}</a>
    </div>
</body>
</html>

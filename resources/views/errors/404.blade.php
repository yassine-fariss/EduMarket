<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EduMarket') }} - 404</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1 class="display-1 fw-bold text-warning">404</h1>
        <h4 class="mb-3">{{ __('Page Not Found') }}</h4>
        <p class="text-muted mb-4">{{ __('The page you are looking for does not exist or has been moved.') }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Back to Home') }}</a>
    </div>
</body>
</html>

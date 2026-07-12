<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EduMarket') }} - 500</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1 class="display-1 fw-bold text-danger">500</h1>
        <h4 class="mb-3">{{ __('Server Error') }}</h4>
        <p class="text-muted mb-4">{{ __('An error occurred. Please try again later.') }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Back to Home') }}</a>
    </div>
</body>
</html>

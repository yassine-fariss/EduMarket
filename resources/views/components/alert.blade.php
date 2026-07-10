@props(['type' => 'info', 'dismissible' => true])

@php
$alertClass = match ($type) {
    'success' => 'alert-success',
    'error', 'danger' => 'alert-danger',
    'warning' => 'alert-warning',
    'info' => 'alert-info',
    default => 'alert-info',
};
@endphp

<div {{ $attributes->merge(['class' => 'alert ' . $alertClass . ($dismissible ? ' alert-dismissible fade show' : '')]) }} role="alert">
    {{ $slot }}

    @if ($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    @endif
</div>

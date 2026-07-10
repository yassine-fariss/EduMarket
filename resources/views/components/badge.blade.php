@props(['type' => 'secondary'])

@php
$badgeClass = match ($type) {
    'success' => 'bg-success',
    'danger' => 'bg-danger',
    'warning' => 'bg-warning text-dark',
    'info' => 'bg-info text-dark',
    'primary' => 'bg-primary',
    'secondary' => 'bg-secondary',
    default => 'bg-secondary',
};
@endphp

<span {{ $attributes->merge(['class' => 'badge ' . $badgeClass]) }}>
    {{ $slot }}
</span>

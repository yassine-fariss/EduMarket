@props(['disabled' => false])

<button @disabled($disabled) {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-secondary']) }}>
    {{ $slot }}
</button>

@props(['disabled' => false])

<button @disabled($disabled) {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }}>
    {{ $slot }}
</button>

@props(['title' => '', 'footer' => ''])

<div {{ $attributes->merge(['class' => 'card shadow-sm']) }}>
    @if ($title)
        <div class="card-header bg-white">
            <h5 class="card-title fw-bold mb-0">{{ $title }}</h5>
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="card-footer bg-white">
            {{ $footer }}
        </div>
    @endif
</div>

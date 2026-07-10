@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div class="invalid-feedback d-block small mt-1">
            {{ $message }}
        </div>
    @endforeach
@endif

@props(['disabled' => false, 'options' => [], 'placeholder' => ''])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'form-select']) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>

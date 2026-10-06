@props([
    'name', 'label', 'type'
])
<div class="grid gap-2">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" class="input" required {{ $attributes }} >
</div>

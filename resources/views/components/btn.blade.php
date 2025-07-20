@props([
    'variant' => 'primary',
    'type' => 'button',
])
@php
    $classes = match($variant) {
        'padrao' => 'btn btn-primary btn-padrao',
        'branco' => 'btn btn-secondary btn-branco',
        'verde' => 'btn btn-secondary btn-verde',
        'vermelho' => 'btn btn-danger btn-vermelho',
        default => 'btn btn-primary btn-padrao',
    };
@endphp

<button {{ $attributes->merge(['class' => $classes, 'type' => $type]) }}>
    {{ $slot }}
</button>

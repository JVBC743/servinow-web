@props([
    'variant' => 'padrao',
    'type' => 'button',
    'size' => 'normal',
    'disabled' => false
])

@php
    $variants = [
        'padrao' => 'btn-padrao',
        'verde' => 'btn-verde',
        'vermelho' => 'btn-vermelho',
        'branco' => 'btn-branco',
        'padrao-detalhado' => 'btn-padrao-detalhado',
        'verde-detalhado' => 'btn-verde-detalhado',
        'vermelho-detalhado' => 'btn-vermelho-detalhado',
        'branco-detalhado' => 'btn-branco-detalhado'
    ];
    
    $sizeClasses = [
        'small' => 'btn-sm',
        'normal' => '',
        'large' => 'btn-lg'
    ];
    
    $class = $variants[$variant] . ' ' . $sizeClasses[$size];
@endphp

<button 
    type="{{ $type }}" 
    class="{{ $class }} {{ $attributes->get('class') }}"
    @if($disabled) disabled @endif
    {{ $attributes->except(['class']) }}
>
    {{ $slot }}
</button>
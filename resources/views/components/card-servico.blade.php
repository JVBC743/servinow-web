@props([
    'imageUrl' => '',
    'price' => 'R$ 00,00',
    'title' => 'Título do serviço',
    'description' => 'Descrição básica sobre o tipo do serviço a ser agendado, da disponibilidade e outras especificações.',
    'buttonText' => 'Contratar',
    'buttonUrl' => '#'
])

<div class="custom-card" {{ $attributes }}>
    <div class="card-img-container">
        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="card-img-top">
    </div>
    <div class="price-tag">{{ $price }}</div>
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $description }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ $buttonUrl }}" class="btn-custom">{{ $buttonText }}</a>
    </div>
</div>  
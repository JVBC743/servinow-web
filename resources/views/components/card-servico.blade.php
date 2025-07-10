@props([
    'imageUrl' => 'https://secohtuh-es.org.br/wp-content/uploads/2024/04/Seguranca-no-Trabalho-Secohtuh.png',
    'price' => 'R$ 00,00',
    'title' => 'Título do serviço',
    'category' => 'Indefinido',
    'description' => 'Descrição básica sobre o tipo do serviço a ser agendado, da disponibilidade e outras especificações.',
    'buttonText' => 'Agendar',
    'buttonUrl' => '#'
])

<div class="custom-card" {{ $attributes }}>
    <div class="card-img-container">
        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="card-img-top">
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h5 class="service-category">{{ $category }}</h5>
        <p class="card-text">{{ $description }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ $buttonUrl }}" class="btn-custom">{{ $buttonText }}</a>
    </div>
</div>  
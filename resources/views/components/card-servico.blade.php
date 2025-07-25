@props([
    'imageUrl' => 'https://secohtuh-es.org.br/wp-content/uploads/2024/04/Seguranca-no-Trabalho-Secohtuh.png',
    'price' => 'R$ 00,00',
    'title' => 'Título do serviço',
    'category' => 'Indefinido',
    'description' => 'Descrição básica sobre o tipo do serviço a ser agendado, da disponibilidade e outras especificações.',
    'buttonText' => 'Agendar',
    'buttonUrl' => '#'
])

<div class="custom-card position-relative" {{ $attributes }}>
    <div class="card-img-container position-relative">
        <img
            src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
            data-src="{{ $imageUrl }}"
            alt="{{ $title }}"
            class="card-img-top lazy"
            loading="lazy">
        
        <div class="position-absolute top-0 end-0 m-3" style="z-index:3;">
            <span class="badge badge-price shadow-lg">
                {{ $price }}
            </span>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h6 class="text-muted">{{ $category }}</h6>
        <p class="card-text">{{ $description }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ $buttonUrl }}" class="btn-custom">{{ $buttonText }}</a>
    </div>
</div>

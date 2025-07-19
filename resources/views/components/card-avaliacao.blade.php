@props([
    'profileImage' => 'images/user-icon.png',
    'title' => 'Nome do Usuário',
    'userName' => 'Pedro',
    'rating' => 1,
    'description' => 'Descrição da avaliação do usuário.'
])

<div class="card card-body card-avaliacao">
    <div class="d-flex align-items-center mb-3">
        <img
            src="{{ asset($profileImage) }}"
            alt="Foto de perfil de {{ $userName }}"
            class="rounded-circle me-3"
            style="width: 48px; height: 48px; object-fit: cover;"
        >

        <div class="flex-grow-1">
            <h5 class="mb-0 fs-5">{{ $title }}</h5>
            <small class="text-muted">{{ $userName }}</small>
        </div>
    </div>

    <div class="mb-2 d-flex align-items-center">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $rating)
                <i class="fas fa-star text-warning me-1" aria-hidden="true"></i>
            @else
                <i class="far fa-star text-muted me-1" aria-hidden="true"></i>
            @endif
        @endfor
        <span class="visually-hidden">Nota: {{ $rating }} de 5</span>
    </div>

    <p class="card-text text-secondary small">{{ $description }}</p>
</div>

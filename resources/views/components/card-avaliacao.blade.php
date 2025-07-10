@props([
    'profileImage' => 'images/user-icon.png',
    'title' => 'Nome do Usuário',
    'userName' => 'Pedro',
    'rating' => 1,
    'description' => 'Descrição da avaliação do usuário.'
    ])

<div class="card card-body card-avaliacao">
    <div class="d-flex align-items-center mb-2">
        <img src="{{ asset($profileImage) }}" alt="Foto de perfil" class="rounded-circle me-2" style="width: 50px; height: 50px; object-fit: cover;">
        
        <div class="d-flex flex-column">
            <h5 class="card-title mb-0 fs-4">{{ $title }}</h5>
            <h5 class="card-title mb-0 fs-6 text-muted">{{ $userName }}</h5>
        </div>
    </div>

    <div class="mb-2">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $rating)
                <i class="fas fa-star text-warning"></i>
            @else
                <i class="far fa-star text-muted"></i>
            @endif
        @endfor
    </div> 

    <p class="card-text fs-6">{{ $description }}</p>
</div>

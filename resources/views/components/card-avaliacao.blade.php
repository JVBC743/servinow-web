@props([
    'profileImage' => 'images/user-icon.png',
    'userName' => 'Nome do Usuário',
    'rating' => 4,
    'description' => 'Descrição do usuário ou avaliação.'
])


    <div class="card card-body card-avaliacao">
        <div class="d-flex align-items-center mb-2">
            <img src="{{ asset($profileImage) }}" alt="Foto de perfil" class="rounded-circle me-2" style="width: 50px; height: 50px; object-fit: cover;">
            <h5 class="card-title mb-0">{{ $userName }}</h5>
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


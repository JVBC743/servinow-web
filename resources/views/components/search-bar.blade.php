@props([
    'action' => '#', 'search' => ''
])

<form action="{{ $action }}" method="GET">
    <div class="search-bar-container">
        <div class="search-bar">
            <input class="search-input" name="search" type="text" placeholder="Buscar Serviço" value="{{ $search }}">
            <button type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

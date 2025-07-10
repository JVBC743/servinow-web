@props([
    'action' => '#',
    'search' => '',
    'categorias' => [],
])


<form action="{{ $action }}" method="GET" class="search-bar-container">
    
    <div class="search-bar-container d-flex align-items-center gap-3">
        <div class="search-bar">
            <input class="search-input" name="search" type="text" placeholder="Buscar Serviço" value="{{ $search }}">
            <button type="submit" aria-label="Buscar">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <select class="form-select" name="categoria_id" onchange="this.form.submit()">
            <option value="">Todas as categorias</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
    </div>
</form>
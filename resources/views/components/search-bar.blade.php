@props([
    'action' => '#',
    'search' => '',
    'categorias' => [],
])


<form action="{{ $action }}" method="GET" class="search-bar-container">
    
    <div class="search-bar-container row g-2">
    <div class="col-12 col-lg">
        <div class="search-bar">
            <input class="search-input" name="search" type="text" placeholder="Buscar Serviço" value="{{ $search }}">
            <button type="submit" aria-label="Buscar">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="col-12 col-md-auto">    
        <select class="form-select w-100" name="categoria_id" onchange="this.form.submit()">
            <option value="">Todas as categorias</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
    </div>
</div>

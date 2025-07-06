@props([
    'action' => '#',
])

<div class="search-bar-container"> 
    <form action="{{ $action }}" method="GET" class="search-bar">
        <input type="text" class="form-control search-input" 
               placeholder="Pesquisar..." name="search">
        <button type="submit" class="search-button">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>


@props([
    'action' => '#',
])

<div class="container my-3 search-bar-container">
    <form action="{{ $action }}" method="GET" class="search-bar d-flex mx-auto">
        <input type="text" class="form-control search-input flex-grow-1" placeholder="Pesquisar..." name="search">
        <button type="submit" class="search-button d-flex align-items-center justify-content-center ms-2">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>

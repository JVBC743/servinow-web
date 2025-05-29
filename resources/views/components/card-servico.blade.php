<div class="card-servico  card shadow-sm mb-3 mx-auto" style="width: 400px;">
    <div
        class="card-servico-header d-flex justify-content-between align-items-center bg-info text-white p-3 rounded-top">
        <div class="nome-servico fs-5 fw-bold mb-0">
            {{ $nomeServico }}
        </div>
        <!-- Card da foto do serviço -->
        <div class="card-foto d-flex align-items-center justify-content-center bg-secondary rounded"
            style="width: 120px; aspect-ratio: 1 / 1;">
            <img src="{{ asset($imagemServico) }}" class="foto-servico img-fluid rounded" alt="Foto do serviço">
        </div>
    </div>

    <!-- Descrição do serviço -->
    <div class="card-body p-3">
        {{ $descricaoServico }}
    </div>
</div>

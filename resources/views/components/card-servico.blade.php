<div class="card-servico">
    <div class="card-servico-header">
        <div class="nome-servico">
            {{ $nomeServico }}
        </div>
        <!-- Card da foto do serviço -->
        <div class="card-foto">
            <img src="{{ asset($imagemServico) }}" class="foto-servico" alt="Foto do serviço">
        </div>
    </div>

    <!-- Descrição do serviço -->
    <div class="card-body">
        {{ $descricaoServico }}
    </div>
</div>

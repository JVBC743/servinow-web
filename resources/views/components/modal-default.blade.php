<div class="modal fade" id="{{ $id ?? 'modalPadrao' }}" tabindex="-1" aria-labelledby="{{ $id ?? 'modalPadrao' }}Label" aria-hidden="true">
    <div class="modal-dialog {{ $size ?? 'modal-dialog-centered' }}">
        <div class="modal-content modal-editar-perfil">
            <div class="modal-header modal-editar-header">
                <h5 class="modal-title modal-editar-title" id="{{ $id ?? 'modalPadrao' }}Label">
                    {{ $title ?? 'Título da Modal' }}
                </h5>
                <button type="button" class="btn-close modal-editar-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer justify-content-between">
                @isset($footer_left)
                    {{ $footer_left }}
                @else
                    <x-btn variant="branco-detalhado" type="button" data-bs-dismiss="modal">
                        <i class="fa-solid fa-times me-2"></i>
                        Fechar
                    </x-btn>
                @endisset
                @isset($footer_right)
                    {{ $footer_right }}
                @endisset
            </div>
        </div>
    </div>
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="toast align-items-center text-white bg-danger border-0 mb-2" role="alert" aria-live="assertive"
                aria-atomic="true" data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">{{ $error }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Fechar"></button>
                </div>
            </div>
        @endforeach
    @endif

    @if (session('success'))
        <div class="toast align-items-center text-white bg-success border-0 mb-2" role="alert" aria-live="assertive"
            aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Fechar"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast align-items-center text-white bg-danger border-0 mb-2" role="alert" aria-live="assertive"
            aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Fechar"></button>
            </div>
        </div>
    @endif
</div>

{{-- Script apenas se houver toasts --}}
@if ($errors->any() || session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElList = [].slice.call(document.querySelectorAll('.toast'))
            toastElList.forEach(function (toastEl) {
                const toast = new bootstrap.Toast(toastEl)
                toast.show()
            })
        });
    </script>
@endif

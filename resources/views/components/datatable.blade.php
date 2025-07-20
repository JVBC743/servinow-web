@props([
    'id' => 'datatable',
    'headers' => [],
    'striped' => true,
    'hover' => true,
    'responsive' => true,
])

@php
    $tableClasses = 'table align-middle text-center';
    if ($striped) $tableClasses .= ' table-striped';
    if ($hover) $tableClasses .= ' table-hover';
    if ($responsive) $tableClasses = 'table-responsive ' . $tableClasses;
@endphp

<div class="{{ $responsive ? 'table-responsive' : '' }}">
    <table id="{{ $id }}" class="{{ $tableClasses }}">
        <thead class="table-light">
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    @endpush
    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    @endpush
@endonce

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#{{ $id }}').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                },
                order: [],
                pageLength: 10
            });
        });
    </script>
@endpush

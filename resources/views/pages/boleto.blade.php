<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Boleto Bancário</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .barcode { font-size: 18px; margin: 20px 0; }
        .qrcode { margin: 20px 0; }
        .info { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Boleto Bancário Simulado</h2>
    <div class="info"><strong>Valor:</strong> R$ {{ number_format($amount, 2, ',', '.') }}</div>
    <div class="info"><strong>Código:</strong> {{ $codigo }}</div>
    <div class="barcode"><strong>Código de Barras:</strong> {{ $barcode }}</div>
    <div class="qrcode">
        <strong>QR Code para pagamento:</strong><br>
        <form id="form-pagar-boleto" action="{{ route('fake.payment.boleto.pagar', ['id' => $codigo]) }}" method="POST" style="display:none;">
            @csrf
        </form>
        @php
            // Gera uma URL que, ao ser acessada, dispara o submit do formulário via JS
            $qrPostUrl = url()->current() . '?pagar=1';
        @endphp
        {!! QrCode::size(200)->generate($qrPostUrl) !!}
    </div>
    <div class="info"><em>Este boleto é apenas para fins de simulação.</em></div>

    @if(request('pagar'))
    <script>
        document.getElementById('form-pagar-boleto').submit();
    </script>
    @endif
</body>
</html>

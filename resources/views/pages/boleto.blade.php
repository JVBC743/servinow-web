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
        <strong>QR Code PIX:</strong><br>
        {!! $qr_code !!}
    </div>
    <div class="info"><em>Este boleto é apenas para fins de simulação.</em></div>
</body>
</html>

<?php

namespace App\Services;

use App\Models\Pagamento;
use App\Models\StatusPagamento;
use App\Models\MetodoPagamento;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FakePaymentGateway implements PaymentGatewayInterface
{
    public function createPayment(float $amount, string $method, array $details = []): array
    {
        $metodoNome = $this->mapMethodName($method);
        $metodo = MetodoPagamento::where('metodo', $metodoNome)->first();
        if (!$metodo) {
            throw new \Exception('Método de pagamento inválido');
        }

        $status = StatusPagamento::where('status', 'Pendente')->first();
        if (!$status) {
            throw new \Exception('Status de pagamento não encontrado');
        }

        $agendamentoId = $details['agendamento_id'] ?? null;
        $codigo = (string) Str::uuid();
        $paymentUrl = route('fake.payment.boleto', ['id' => $codigo]);

        // Simulação de dados extras por método
        $extra = [];
        switch ($metodoNome) {
            case 'PIX':
                $extra['qr_code'] = QrCode::size(200)->generate($paymentUrl);
                break;
            case 'Boleto Bancário':
                $fakeBarCode = '23790.12345 60000.123456 70000.123456 1 12340000010000';
                $extra['pdf_url'] = route('fake.payment.boleto', ['id' => $codigo]);
                $extra['barcode'] = $fakeBarCode;
                $extra['qr_code'] = QrCode::size(200)->generate($paymentUrl);
                break;
            case 'Cartão de Crédito':
            case 'Cartão de Débito':
                // Simula cobrança automática e armazena dados do cartão de forma segura (exemplo: criptografia)
                if (empty($details['card_number']) || empty($details['card_holder']) || empty($details['card_expiry']) || empty($details['card_cvv'])) {
                    throw new \Exception('Dados do cartão incompletos');
                }
                // Exemplo de armazenamento seguro (use criptografia real em produção)
                $encryptedCard = encrypt(json_encode([
                    'number' => $details['card_number'],
                    'holder' => $details['card_holder'],
                    'expiry' => $details['card_expiry'],
                    'cvv'    => $details['card_cvv'],
                ]));
                $extra['card_token'] = $encryptedCard;
                // Simula pagamento aprovado automaticamente
                $status = StatusPagamento::where('status', 'Pago')->first();
                break;
        }

        Pagamento::create([
            'id_agendamento' => $agendamentoId,
            'status' => $status->id,
            'data_pagamento' => $status->status === 'Pago' ? now() : null,
            'metodo' => $metodo->id,
            'codigo' => $codigo,
        ]);

        return array_merge([
            'id' => $codigo,
            'amount' => $amount,
            'status' => strtolower($status->status),
            'payment_url' => $paymentUrl,
        ], $extra);
    }

    public function checkPaymentStatus(string $paymentId): string
    {
        $pagamento = Pagamento::where('codigo', $paymentId)->first();

        if (!$pagamento) {
            return 'not_found';
        }

        // Retorna o status pelo nome
        return $pagamento->status ? strtolower($pagamento->statusR->status) : 'unknown';
    }

    public function confirmPayment(string $paymentId): void
    {
        $pagamento = Pagamento::where('codigo', $paymentId)->first();

        if ($pagamento) {
            // Só permite confirmar se estiver pendente
            if ($pagamento->status && strtolower($pagamento->statusR->status) === 'pendente') {
                $statusPago = StatusPagamento::where('status', 'Pago')->first();
                $pagamento->update([
                    'status' => $statusPago ? $statusPago->id : $pagamento->status,
                    'data_pagamento' => now(),
                ]);
            }
        }
    }

    public function cancelPayment(string $paymentId): void
    {
        $pagamento = Pagamento::where('codigo', $paymentId)->first();

        if ($pagamento) {
            // Só permite cancelar se estiver pendente
            if ($pagamento->status && strtolower($pagamento->statusR->status) === 'pendente') {
                $statusCancelado = StatusPagamento::where('status', 'Cancelado')->first();
                $pagamento->update([
                    'status' => $statusCancelado ? $statusCancelado->id : $pagamento->status,
                ]);
            }
        }
    }

    public function getAvailableMethods(): array
    {
        return MetodoPagamento::pluck('metodo')->toArray();
    }

    // Mapeia nomes amigáveis para os nomes dos seeders
    private function mapMethodName(string $method): string
    {
        $map = [
            'pix' => 'PIX',
            'cartao_credito' => 'Cartão de Crédito',
            'cartao_debito' => 'Cartão de Débito',
            'boleto' => 'Boleto Bancário',
        ];
        return $map[$method] ?? $method;
    }
}

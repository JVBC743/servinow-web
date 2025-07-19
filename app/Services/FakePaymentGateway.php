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
        // Busca o método de pagamento pelo nome
        $metodo = MetodoPagamento::where('metodo', $this->mapMethodName($method))->first();
        if (!$metodo) {
            throw new \Exception('Método de pagamento inválido');
        }

        // Busca o status "Pendente"
        $status = StatusPagamento::where('status', 'Pendente')->first();
        if (!$status) {
            throw new \Exception('Status de pagamento não encontrado');
        }

        // O agendamento pode ser passado em $details['agendamento_id']
        $agendamentoId = $details['agendamento_id'] ?? null;

        $codigo = (string) Str::uuid();
        $paymentUrl = route('fake.payment.show', ['id' => $codigo]);

        Pagamento::create([
            'id_agendamento' => $agendamentoId,
            'status' => $status->id,
            'data_pagamento' => null,
            'metodo' => $metodo->id,
            'codigo' => $codigo,
        ]);

        return [
            'id' => $codigo,
            'amount' => $amount,
            'status' => 'pending',
            'qr_code' => QrCode::size(200)->generate($paymentUrl),
            'payment_url' => $paymentUrl,
        ];
    }

    public function checkPaymentStatus(string $paymentId): string
    {
        $pagamento = Pagamento::where('codigo', $paymentId)->first();

        if (!$pagamento) {
            return 'not_found';
        }

        // Retorna o status pelo nome
        return $pagamento->status ? strtolower($pagamento->status->status) : 'unknown';
    }

    public function confirmPayment(string $paymentId): void
    {
        $pagamento = Pagamento::where('codigo', $paymentId)->first();

        if ($pagamento) {
            // Só permite confirmar se estiver pendente
            if ($pagamento->status && strtolower($pagamento->status->status) === 'pendente') {
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
            if ($pagamento->status && strtolower($pagamento->status->status) === 'pendente') {
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

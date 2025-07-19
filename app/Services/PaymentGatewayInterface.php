<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    /**
     * Cria um pagamento para um valor e método específico.
     *
     * @param float $amount Valor do pagamento
     * @param string $method Método de pagamento ('pix', 'cartao_credito', 'cartao_debito', 'boleto')
     * @param array $details Dados adicionais para o pagamento (ex: dados do cartão)
     * @return array Dados do pagamento criado (ex: id, status, link, qr_code, etc)
     */
    public function createPayment(float $amount, string $method, array $details = []): array;

    /**
     * Consulta o status do pagamento por ID.
     *
     * @param string $paymentId
     * @return string Status atual ('pending', 'paid', 'cancelled', etc)
     */
    public function checkPaymentStatus(string $paymentId): string;

    /**
     * Confirma manualmente o pagamento (simula aprovação).
     *
     * @param string $paymentId
     * @return void
     */
    public function confirmPayment(string $paymentId): void;

    /**
     * Cancela um pagamento.
     *
     * @param string $paymentId
     * @return void
     */
    public function cancelPayment(string $paymentId): void;

    /**
     * Retorna os métodos de pagamento disponíveis.
     *
     * @return array
     */
    public function getAvailableMethods(): array;
}

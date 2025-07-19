<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    public function createPayment(float $amount): array;
    public function checkPaymentStatus(string $paymentId): string;
}

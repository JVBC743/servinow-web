<?php

namespace App\Services;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FakePaymentGateway implements PaymentGatewayInterface
{
    protected static $payments = [];

    public function createPayment(float $amount): array
    {
        $paymentId = Str::uuid();
        $paymentUrl = route('fake.payment.show', ['id' => $paymentId]);
        self::$payments[$paymentId] = 'pending';

        return [
            'id' => $paymentId,
            'amount' => $amount,
            'status' => 'pending',
            'qr_code' => QrCode::size(200)->generate($paymentUrl),
            'payment_url' => $paymentUrl,
        ];
    }

    public function checkPaymentStatus(string $paymentId): string
    {
        return self::$payments[$paymentId] ?? 'not_found';
    }

    public static function confirmPayment(string $paymentId)
    {
        self::$payments[$paymentId] = 'paid';
    }
}

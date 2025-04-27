<?php

namespace App\Infrastructure\Services;

class EmailService {
    public function send(string $to, string $message) {
        // Mail::to($to)->send(new CustomMail($message));
    }
}

<?php

namespace App\Application\Interfaces;

interface MailServiceInterface {
    public function send(string $to, string $subject, string $message): void;
}

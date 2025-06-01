<?php

namespace App\Application\Interfaces;

interface ServicoEmailInterface {
    public function send(string $to, string $subject, string $message): void;
}

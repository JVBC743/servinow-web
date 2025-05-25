<?php

namespace App\Application\Interfaces;

interface HashProviderInterface
{
    public function make(string $password): string;
}

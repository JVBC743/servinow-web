<?php

namespace App\Application\Interfaces;

use Illuminate\Contracts\Auth\Authenticatable;

interface AuthServiceInterface
{
    public function attempt(array $credentials): bool;
    public function user(): ?Authenticatable;
}

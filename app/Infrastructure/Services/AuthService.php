<?php

namespace App\Infrastructure\Services;

use App\Application\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthService implements AuthServiceInterface
{
    public function attempt(array $credentials): bool
    {
        return Auth::guard('web')->attempt($credentials);
    }

    public function user(): ?Authenticatable
    {
        return Auth::guard('web')->user();
    }
}

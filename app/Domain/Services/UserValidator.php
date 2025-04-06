<?php

namespace App\Domain\Services;

use App\Domain\Entities\User;

class UserValidator {
    public function isValidEmail(User $user): bool {
        return filter_var($user->email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

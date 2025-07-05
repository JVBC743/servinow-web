<?php

namespace App\Domain\Services;

use App\Domain\Entities\Usuario;

class ValidadorUsuario {
    public function isValidEmail(Usuario $user): bool {
        return filter_var($user->email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

<?php

namespace App\Http\Controllers;

use App\Application\DTOs\CreateUserDTO;
use App\Application\UseCases\CreateUserUseCase;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function store(Request $request, CreateUserUseCase $useCase) {
        $dto = new CreateUserDTO(
            name: $request->input('name'),
            email: $request->input('email')
        );

        $useCase->execute($dto);

        return response()->json(['message' => 'Usuário criado']);
    }
}

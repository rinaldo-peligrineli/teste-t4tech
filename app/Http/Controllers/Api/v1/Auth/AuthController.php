<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\AuthFormRequest;

class AuthController extends Controller
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function login(AuthFormRequest $request): JsonResponse
    {
        try {
            $email = $request->email;
            $user = $this->userRepository->getUserByEmail($email);

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Usuário ou senha invalidos'
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'message' => 'Login Efetuado com Sucesso',
                'user' => $user,
                'token' => $user->createToken('token-name')->plainTextToken,
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar efetuar o login',
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_OK);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['Logout efetuado com sucesso'], JsonResponse::HTTP_OK);
    }
}

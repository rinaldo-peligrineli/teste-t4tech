<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request) {
        $email = $request->email;

        $user = $this->userRepository->getUserByEmail($email);


        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Usuário ou senha invalidos'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'message' => 'Login Efetuado com Sucesso',
            'user' => $user,
            'token' => $user->createToken('token-name')->plainTextToken,
        ], JsonResponse::HTTP_OK);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(['Logout efetuado com sucesso'],JsonResponse::HTTP_OK);
    }
}

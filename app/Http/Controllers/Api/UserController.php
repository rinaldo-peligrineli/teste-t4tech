<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        try {

            $users = UserResource::collection($this->userRepository->getAllUsers());
            return response()->json([
                'data' => $users,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id) {
        try {
            $users = new UserResource($this->userRepository->getUserById($id));
            return response()->json([
                'data' => $users,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        try {

            $arrUsers = $request->all();
            $arrUsers['password'] = bcrypt($request->password);
            $users = new UserResource($this->userRepository->createUser($arrUsers));
            return response()->json([
                'data' => $users,
            ], JsonResponse::HTTP_CREATED);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function search(Request $request) {
        try {
            $column = '';
            $value = '';
            if($request->has('name')) {
                $column = 'name';
                $value = $request->name;
            }

            if($request->has('email')) {
                $column = 'email';
                $value = $request->email;
            }

            $users = UserResource::collection($this->userRepository->searchUserByColumn($column, $value));
            return response()->json([
                'data' => $users,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update($id, Request $request) {
        try {
            $arrUsers = $request->all();

            $arrUsers['password'] = bcrypt($request->password);
            $this->userRepository->updateUser($id, $arrUsers);
            $users = new UserResource($this->userRepository->getUserById($id));
            return response()->json([
                'data' => $users,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id) {
        try {
            $this->userRepository->deleteUser($id);

            return response()->json([
                'message' => 'Usuario excluido com sucesso'
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function index(): JsonResponse {
        try {

            $users = UserResource::collection($this->userRepository->getAllUsers());
            return response()->json([
                'data' => $users,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse {
        try {
            $users = new UserResource($this->userRepository->getUserById($id));
            return response()->json([
                'data' => $users,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(UserStoreRequest $request): JsonResponse {
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
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function search(Request $request): JsonResponse {
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
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update($id, UserUpdateRequest $request): JsonResponse {
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
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id): JsonResponse {
        try {
            $this->userRepository->deleteUser($id);

            return response()->json([
                'message' => 'Usuario excluido com sucesso'
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

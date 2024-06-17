<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Services\UserRoleAndPermissionService;
class UserController extends Controller
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserRoleAndPermissionService $userRoleAndPermissionService
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
            $userAuth = $this->userRepository->getUserById(auth()->user()->id);


            $user = new UserResource($this->userRepository->createUser($request->all()));
            $users = [];
            $message = '';

            if(($request->has('is_admin') && $request->is_admin === true) && $userAuth->hasRole('admin') )   {
                $this->userRoleAndPermissionService->saveUserWhithRoleAdmin($user, false);
                $message = 'Usuario com Perfil de Admin Criado com sucesso';
            }

            if((!$request->has('is_admin') || $request->is_admin === false) || $userAuth->hasRole('user')) {
                $this->userRoleAndPermissionService->saveUserWhithRoleUser($user, false);
                $message = "Usuario com Perfil de User Criado com sucesso";
            }

            return response()->json([
                'message' => $message,
                'data' => $user,
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
            $userAuth = $this->userRepository->getUserById(auth()->user()->id);
            $user = $this->userRepository->getUserById($id);
            $arrUsers = $request->all();
            $this->userRepository->updateUser($id, $arrUsers);
            $message = '';

            $this->userRoleAndPermissionService->removeRolesAndPermissionsFromUser($id);

            if(($request->has('is_admin') && $request->is_admin === true) && $userAuth->hasRole('admin') )   {
                $this->userRoleAndPermissionService->saveUserWhithRoleAdmin($user, true);
                $message = 'Usuario com Perfil de Admin salvo com sucesso';
            }

            if((!$request->has('is_admin') || $request->is_admin === false) || $userAuth->hasRole('user')) {
                $this->userRoleAndPermissionService->saveUserWhithRoleUser($user, true);
                $message = "Usuario com Perfil de User salvo com sucesso";
            }


            return response()->json([
                'message' => $message,
                'data' => $user,
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

            $user = $this->userRepository->getUserById(auth()->user()->id);
            $permissions = $user->getPermissionNames();

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

<?php

namespace App\Http\Controllers\Api\v1\Balldontlie;

use App\Interfaces\Balldontlie\BalldontlieTeamRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Balldontlie\BalldontlieTeamResource;
use App\Http\Requests\Balldontlie\BalldontlieTeamStoreRequest;
use App\Http\Requests\Balldontlie\BalldontlieTeamUpdateRequest;

class BalldontlieTeamsController extends Controller
{
    public function __construct(
        private readonly BalldontlieTeamRepositoryInterface $balldontlieTeamRepositoryInterface
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            $teams = BalldontlieTeamResource::collection($this->balldontlieTeamRepositoryInterface->getAllTeams());
            return response()->json([
                'data' => $teams,
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(BalldontlieTeamStoreRequest $request): JsonResponse
    {
        try {
            $team = new BalldontlieTeamResource($this->balldontlieTeamRepositoryInterface->createTeam($request->all()));
            return response()->json([
                'data' => $team,
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, BalldontlieTeamUpdateRequest $request): JsonResponse
    {
        try {
            new BalldontlieTeamResource(
                $this->balldontlieTeamRepositoryInterface->updateTeam($id, $request->all())
            );

            return response()->json([
                'message' => "Team {$id} atualizado com sucesso",
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function search(Request $request): JsonResponse
    {
        try {
            $column = '';
            $value = '';
            if ($request->has('name')) {
                $column = 'name';
                $value = $request->name;
            }

            if ($request->has('full_name')) {
                $column = 'full_name';
                $value = $request->full_name;
            }

            $team = BalldontlieTeamResource::collection(
                $this->balldontlieTeamRepositoryInterface->searchByColumn($column, $value)
            );

            return response()->json([
                'data' => $team,
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $team = new BalldontlieTeamResource($this->balldontlieTeamRepositoryInterface->getTeamById($id));
            return response()->json([
                'data' => $team,
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->balldontlieTeamRepositoryInterface->deleteTeam($id);

            return response()->json([
                'message' => 'Time excluido com sucesso'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

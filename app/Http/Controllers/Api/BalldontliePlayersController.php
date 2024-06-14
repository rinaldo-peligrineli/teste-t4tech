<?php

namespace App\Http\Controllers\Api;

use App\Services\BalldontlieService;
use App\Interfaces\BalldontliesTeamsRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BalldontliesTeamsResource;

class BalldontliePlayersController extends Controller
{
    private $balldontlieTeamsService;
    private BalldontliesTeamsRepositoryInterface $balldontliesTeamsRepositoryInterface;

    public function __construct(
        BalldontlieService $balldontlieTeamsService,
        BalldontliesTeamsRepositoryInterface $balldontliesTeamsRepositoryInterface

    ) {
        $this->balldontlieTeamsService = $balldontlieTeamsService;
        $this->balldontliesTeamsRepositoryInterface = $balldontliesTeamsRepositoryInterface;
    }

    public function index() {
        try {
            $teams = BalldontliesTeamsResource::collection($this->balldontliesTeamsRepositoryInterface->getAllTeams());
            return response()->json([
                'data' => $teams,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        try {
            $team = new BalldontliesTeamsResource( $this->balldontliesTeamsRepositoryInterface->createTeam($request->all()));
            return response()->json([
                'data' => $team,
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

            if($request->has('full_name')) {
                $column = 'full_name';
                $value = $request->full_name;
            }


            $team = BalldontliesTeamsResource::collection($this->balldontliesTeamsRepositoryInterface->searchByColumn($column, $value));
            return response()->json([
                'data' => $team,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id) {
        try {
            $team = new BalldontliesTeamsResource($this->balldontliesTeamsRepositoryInterface->getTeamById($id));
            return response()->json([
                'data' => $team,
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
            $this->balldontliesTeamsRepositoryInterface->deleteTeam($id);

            return response()->json([
                'message' => 'Time excluido com sucesso'
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

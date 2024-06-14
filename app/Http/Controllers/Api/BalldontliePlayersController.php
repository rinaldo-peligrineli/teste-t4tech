<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\BalldontliesPlayersRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BalldontliesPlayersResource;

class BalldontliePlayersController extends Controller
{

    private BalldontliesPlayersRepositoryInterface $balldontliesPlayersRepositoryInterface;

    public function __construct(

        BalldontliesPlayersRepositoryInterface $balldontliesPlayersRepositoryInterface

    ) {
        $this->balldontliesPlayersRepositoryInterface = $balldontliesPlayersRepositoryInterface;
    }

    public function index(Request $request) {

        try {
            $perPage = $request->has('perPage') ? $request->per_page : 20;
            $page = $request->has('page') ? $request->page : 1;

            $players = BalldontliesPlayersResource::collection($this->balldontliesPlayersRepositoryInterface->getAllPlayersPaginate($perPage, $page));
            return response()->json([
                'data' => $players,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        try {
            $team = new BalldontliesPlayersResource( $this->balldontliesPlayersRepositoryInterface->createPlayer($request->all()));
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
            if($request->has('first_name')) {
                $column = 'first_name';
                $value = $request->first_name;
            }

            if($request->has('last_name')) {
                $column = 'last_name';
                $value = $request->last_name;
            }


            $team = BalldontliesPlayersResource::collection($this->balldontliesPlayersRepositoryInterface->searchByColumn($column, $value));
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
            $player = new BalldontliesPlayersResource($this->balldontliesPlayersRepositoryInterface->getPlayerById($id));
            return response()->json([
                'data' => $player,
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
            $this->balldontliesPlayersRepositoryInterface->deletePlayer($id);

            return response()->json([
                'message' => 'Jogador excluido com sucesso'
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

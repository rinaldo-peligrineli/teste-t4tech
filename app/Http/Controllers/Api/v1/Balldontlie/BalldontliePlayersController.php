<?php

namespace App\Http\Controllers\Api\v1\Balldontlie;

use App\Interfaces\Balldontlie\BalldontliePlayerRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Balldontlie\BalldontliePlayerResource;
use App\Http\Requests\Balldontlie\BalldontliePlayerStoreRequest;
use App\Http\Requests\Balldontlie\BalldontliePlayerUpdateRequest;
use App\Models\BalldontliePlayer;
class BalldontliePlayersController extends Controller
{

    public function __construct(
        private readonly BalldontliePlayerRepositoryInterface $balldontliePlayerRepositoryInterface
    ) {}

    public function index(Request $request): JsonResponse {

        try {
            $perPage = $request->has('perPage') ? $request->per_page : 20;
            $page = $request->has('page') ? $request->page : 1;

            $players = BalldontliePlayerResource::collection($this->balldontliePlayerRepositoryInterface->getAllPlayersPaginate($perPage, $page));
            return response()->json([
                'data' => $players,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(BalldontliePlayerStoreRequest $request): JsonResponse {
        try {


            //$player = new BalldontliePlayerResource( $this->balldontliePlayerRepositoryInterface->createPlayer($request->all()));
            $player = BalldontliePlayer::create($request->all());
            return response()->json([
                'data' => $player,
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
            if($request->has('first_name')) {
                $column = 'first_name';
                $value = $request->first_name;
            }

            if($request->has('last_name')) {
                $column = 'last_name';
                $value = $request->last_name;
            }

            $players = BalldontliePlayerResource::collection($this->balldontliePlayerRepositoryInterface->searchByColumn($column, $value));
            return response()->json([
                'data' => $players,
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
            $player = new BalldontliePlayerResource($this->balldontliePlayerRepositoryInterface->getPlayerById($id));
            return response()->json([
                'data' => $player,
            ], JsonResponse::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'data' => [],
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, BalldontliePlayerUpdateRequest $request): JsonResponse {
        try {
            $player = new BalldontliePlayerResource($this->balldontliePlayerRepositoryInterface->getPlayerById($id));
            return response()->json([
                'message' => "Jogador {$id} atualizado com sucesso",
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
            $this->balldontliePlayerRepositoryInterface->deletePlayer($id);

            return response()->json([
                'message' => 'Jogador excluido com sucesso'
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

<?php

namespace App\Interfaces\Balldontlie;

interface BalldontliePlayerRepositoryInterface
{
    public function getAllPlayers();
    public function getAllPlayersPaginate($perPage, $page);
    public function getPlayerById($id);
    public function deletePlayer($id);
    public function searchByColumn($column, $value);
    public function createPlayer(array $playerInfo);
    public function updatePlayer($id, array $newInfo);
}

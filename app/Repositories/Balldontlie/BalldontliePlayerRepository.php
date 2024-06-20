<?php

namespace App\Repositories\Balldontlie;

use App\Interfaces\Balldontlie\BalldontliePlayerRepositoryInterface;
use App\Models\BalldontliePlayer;

class BalldontliePlayerRepository implements BalldontliePlayerRepositoryInterface
{
    public function getAllPlayers()
    {
        return BalldontliePlayer::with('balldontlieTeam')->all();
    }

    public function getAllPlayersPaginate($perPage, $page)
    {
        return BalldontliePlayer::with('balldontlieTeam')->paginate($perPage, ['*'], 'page', $page);
    }

    public function getPlayerById($id)
    {
        return BalldontliePlayer::with('balldontlieTeam')->find($id);
    }

    public function deletePlayer($id)
    {
        BalldontliePlayer::destroy($id);
    }

    public function createPlayer(array $playerDetails)
    {
        return BalldontliePlayer::create($playerDetails);
    }

    public function updatePlayer($id, array $newDetails)
    {
        return BalldontliePlayer::find($id)->update($newDetails);
    }

    public function searchByColumn($column, $value) {
        return BalldontliePlayer::with('balldontlieTeam')
            ->where($column, 'LIKE', "%{$value}%")
            ->get();


    }
}

<?php

namespace App\Repositories\Balldontlie;

use App\Interfaces\Balldontlie\BalldontliePlayerRepositoryInterface;
use App\Models\BalldontliePlayer;

class BalldontliePlayerRepository implements BalldontliePlayerRepositoryInterface
{
    public function getAllPlayers()
    {
        return BalldontliePlayer::select('balldontlie_players.*', 'balldontlies_teams.id as team_id', 'balldontlies_teams.conference')->join('balldontlies_teams', 'balldontlies_teams.balldontlie_team_id', '=', 'balldontlie_players.balldontlies_team_id')->get();
    }

    public function getAllPlayersPaginate($perPage, $page)
    {
        return BalldontliePlayer::select('balldontlie_players.*', 'balldontlies_teams.id as team_id', 'balldontlies_teams.conference')->join('balldontlies_teams', 'balldontlies_teams.balldontlie_team_id', '=', 'balldontlie_players.balldontlies_team_id')
            ->orderBy('balldontlie_players.id')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function getPlayerById($id)
    {
        return BalldontliePlayer::
            select('balldontlie_players.*', 'balldontlies_teams.id as team_id', 'balldontlies_teams.conference')
            ->join('balldontlies_teams', 'balldontlies_teams.balldontlie_team_id', '=', 'balldontlie_players.balldontlies_team_id')
            ->findOrFail($id);
    }

    public function deletePlayer($id)
    {
        BalldontliePlayer::destroy($id);
    }

    public function createPlayer(array $teamDetails)
    {
        return BalldontliePlayer::create($teamDetails);
    }

    public function updatePlayer($id, array $newDetails)
    {
        return BalldontliePlayer::find($id)->update($newDetails);
    }

    public function searchByColumn($column, $value) {
        return BalldontliePlayer::
            select('balldontlie_players.*', 'balldontlies_teams.id as team_id', 'balldontlies_teams.conference')
            ->join('balldontlies_teams', 'balldontlies_teams.balldontlie_team_id', '=', 'balldontlie_players.balldontlies_team_id')
            ->where($column, 'LIKE', "%{$value}%")
            ->get();


    }
}

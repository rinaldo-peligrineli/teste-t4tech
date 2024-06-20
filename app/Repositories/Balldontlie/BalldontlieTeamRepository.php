<?php

namespace App\Repositories\Balldontlie;

use App\Interfaces\Balldontlie\BalldontlieTeamRepositoryInterface;
use App\Models\BalldontlieTeam;

class BalldontlieTeamRepository implements BalldontlieTeamRepositoryInterface
{
    public function getAllTeams()
    {
        return BalldontlieTeam::all();
    }

    public function getTeamById($id)
    {
        return BalldontlieTeam::findOrFail($id);
    }

    public function deleteTeam($id)
    {
        BalldontlieTeam::destroy($id);
    }

    public function createTeam(array $teamDetails)
    {
        return BalldontlieTeam::create($teamDetails);
    }

    public function updateTeam($id, array $newDetails)
    {
        return BalldontlieTeam::find($id)->update($newDetails);
    }

    public function searchByColumn($column, $value) {
        return BalldontlieTeam::where($column, 'LIKE', "%{$value}%")->get();
    }
}

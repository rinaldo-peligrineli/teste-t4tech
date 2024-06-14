<?php

namespace App\Repositories;

use App\Interfaces\BalldontliesTeamsRepositoryInterface;
use App\Models\BalldontliesTeams;

class BalldontliesTeamsRepository implements BalldontliesTeamsRepositoryInterface
{
    public function getAllTeams()
    {
        return BalldontliesTeams::all();
    }

    public function getTeamById($id)
    {
        return BalldontliesTeams::findOrFail($id);
    }

    public function deleteTeam($id)
    {
        BalldontliesTeams::destroy($id);
    }

    public function createTeam(array $teamDetails)
    {
        return BalldontliesTeams::create($teamDetails);
    }

    public function updateTeam($id, array $newDetails)
    {
        return BalldontliesTeams::find($id)->update($newDetails);
    }

    public function searchByColumn($column, $value) {
        return BalldontliesTeams::where($column, 'LIKE', "%{$value}%")->get();
    }
}

<?php

namespace App\Interfaces\Balldontlie;

interface BalldontlieTeamRepositoryInterface
{
    public function getAllTeams();
    public function getTeamById($id);
    public function deleteTeam($id);
    public function searchByColumn($column, $value);
    public function createTeam(array $teamInfo);
    public function updateTeam($id, array $newInfo);
}

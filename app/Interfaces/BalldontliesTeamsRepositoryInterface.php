<?php

namespace App\Interfaces;

interface BalldontliesTeamsRepositoryInterface
{
    public function getAllTeams();
    public function getTeamById($id);
    public function deleteTeam($id);
    public function searchByColumn($column, $value);
    public function createTeam(array $userInfo);
    public function updateTeam($id, array $newInfo);
}

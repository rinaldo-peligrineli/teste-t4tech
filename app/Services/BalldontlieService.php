<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\BalldontliesTeams;


class BalldontlieService {

    const PATH = 'https://api.balldontlie.io/v1';


    public function getTeams() {

        $response = Http::withHeaders([
            'Authorization' => 'eabe2808-4427-4606-832d-c83bf8f1cbc3',
        ])->get(sprintf('%s%s', self::PATH, '/teams'));


        $teams = json_decode($response->body());

        foreach($teams->data as $team) {
            BalldontliesTeams::create((array)$team);
        }
    }
}

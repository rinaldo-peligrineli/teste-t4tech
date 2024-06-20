<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BalldontlieTeam;

class GetBalldontlieTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balldontlie-teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Balldontlie Teams';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = config('balldontlieapi.config.url');
        $apiKey = config('balldontlieapi.config.api_key');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get(sprintf('%s%s', $url, '/teams'));

        $teams = json_decode($response->body());


        $arrTeam = [];

        foreach($teams->data as $team) {
            $arrTeam["balldontlie_team_id"] = $team->id;
            $arrTeam["conference"] = $team->conference;
            $arrTeam["division"] = $team->division;
            $arrTeam["city"] = $team->city;
            $arrTeam["name"] = $team->name;
            $arrTeam["full_name"] = $team->full_name;
            $arrTeam["abbreviation"] = $team->abbreviation;

            BalldontlieTeam::create($arrTeam);
        }

        $this->info('Registros inseridos');
    }
}

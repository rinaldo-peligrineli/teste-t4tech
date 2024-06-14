<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BalldontliesTeams;

class GetBalldontlieTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balldontlie-teams:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Balldontlie Teams';

    const PATH = 'https://api.balldontlie.io/v1';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'Authorization' => 'eabe2808-4427-4606-832d-c83bf8f1cbc3',
        ])->get(sprintf('%s%s', self::PATH, '/teams'));


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

            BalldontliesTeams::create($arrTeam);
        }

        $this->info('Registros inseridos');
    }
}

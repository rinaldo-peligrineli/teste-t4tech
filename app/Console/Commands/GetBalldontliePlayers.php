<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BalldontliePlayer;
use App\Models\BalldontlieTeam;

class GetBalldontliePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balldontlie-players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Balldontlie Players';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $next_cursor = 0;
        $count = 0;

        $url = config('balldontlieapi.config.url');
        $apiKey = config('balldontlieapi.config.api_key');

        $teams = BalldontlieTeam::all()->pluck('id', 'balldontlie_team_id');

        do {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->get(sprintf('%s%s', $url, '/players?cursor='. $next_cursor.'&per_page=100'));

            $players = json_decode($response->body());

            foreach($players->data as $data) {
                $arrPlayer['balldontlie_player_origin_id'] = $data->id;
                $arrPlayer['first_name'] = $data->first_name;
                $arrPlayer['last_name']= $data->last_name;
                $arrPlayer['position'] = $data->position;
                $arrPlayer['height'] = $data->height;
                $arrPlayer['weigth'] = $data->weight;
                $arrPlayer['jersey_number'] = $data->jersey_number;
                $arrPlayer['college'] = $data->college;
                $arrPlayer['country'] = $data->country;
                $arrPlayer['draft_year'] = $data->draft_year;
                $arrPlayer['draft_round'] = $data->draft_round;
                $arrPlayer['draft_number'] = $data->draft_number;
                $arrPlayer['balldontlie_team_id'] = $teams[$data->team->id];

                BalldontliePlayer::create($arrPlayer);
                $count++;

            }

            if(!property_exists($players->meta, "next_cursor")) {
                break;
            }

            $next_cursor = $players->meta->next_cursor;

            sleep(2);

        } while (true);


        $this->info("Total de Registros inseridos {$count}");
    }
}

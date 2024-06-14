<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BalldontliePlayer;

class GetBalldontliePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balldontlie-players:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Balldontlie Players';

    const PATH = 'https://api.balldontlie.io/v1';
    /**
     * Execute the console command.
     */
    public function handle()
    {

        $next_cursor = 0;
        $dataPlayers = [];
        $count = 0;

        do {
            $response = Http::withHeaders([
                'Authorization' => 'eabe2808-4427-4606-832d-c83bf8f1cbc3',
            ])->get(sprintf('%s%s', self::PATH, '/players?cursor='. $next_cursor.'&per_page=100'));


            $players = json_decode($response->body());
            $dataPlayers = $players->data;

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
                $arrPlayer['balldontlies_team_id'] = $data->team->id;

                BalldontliePlayer::create($arrPlayer);
                $count++;
            }

            if(!property_exists($players->meta, "next_cursor")) {
                break;
            }

            $next_cursor = $players->meta->next_cursor;

            sleep(2);

        } while (count($dataPlayers) > 0);


        $this->info("Total de Registros inseridos {$count}");
    }
}

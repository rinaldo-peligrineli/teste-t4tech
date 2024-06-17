<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalldontliePlayer extends Model
{
    use HasFactory;

    protected $table = 'balldontlie_players';

    protected $fillable = [
        'balldontlie_player_origin_id',
        'first_name',
        'last_name',
        'position',
        'height',
        'weigth',
        'jersey_number',
        'college',
        'country',
        'draft_year',
        'draft_round',
        'draft_number',
        'balldontlies_team_id'
    ];

}

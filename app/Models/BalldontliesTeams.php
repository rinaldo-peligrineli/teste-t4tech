<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalldontliesTeams extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'balldontlies_teams';

    protected $fillable = [
        'balldontlie_team_id',
        'conference',
        'division',
        'city',
        'name',
        'full_name',
        'abbreviation'
    ];



}

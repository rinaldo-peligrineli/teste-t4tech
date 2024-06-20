<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalldontlieTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'balldontlie_team';

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

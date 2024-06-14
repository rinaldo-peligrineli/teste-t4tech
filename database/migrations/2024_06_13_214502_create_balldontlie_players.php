<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balldontlie_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('balldontlie_player_origin_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->string('height');
            $table->string('weigth');
            $table->string('jersey_number');
            $table->string('college');
            $table->string('country');
            $table->integer('draft_year');
            $table->integer('draft_round');
            $table->integer('draft_number');
            $table->foreignId('balldontlies_team_id')->constrained('balldontlies_teams', 'balldontlie_team_id', 'balldontlies_teams_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balldontlie_players');
    }
};

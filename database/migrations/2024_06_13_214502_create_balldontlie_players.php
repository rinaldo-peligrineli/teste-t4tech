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
            $table->unsignedBigInteger('balldontlie_player_origin_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('position')->nullable();
            $table->string('height')->nullable();
            $table->string('weigth')->nullable();
            $table->string('jersey_number')->nullable();
            $table->string('college')->nullable();
            $table->string('country')->nullable();
            $table->integer('draft_year')->nullable();
            $table->integer('draft_round')->nullable();
            $table->integer('draft_number')->nullable();
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

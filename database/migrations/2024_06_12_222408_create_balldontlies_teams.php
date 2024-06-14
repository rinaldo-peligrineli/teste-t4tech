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
        Schema::create('balldontlies_teams', function (Blueprint $table) {
            $table->id();
            $table->string('conference');
            $table->unsignedBigInteger('balldontlie_team_id');
            $table->string('division');
            $table->string('city');
            $table->string('name');
            $table->string('full_name');
            $table->string('abbreviation');
            $table->index(['balldontlie_team_id'], 'balldontlies_teams_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balldontlies_teams');
    }
};

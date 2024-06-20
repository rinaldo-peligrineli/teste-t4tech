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
        Schema::create('balldontlie_team', function (Blueprint $table) {
            $table->id();
            $table->string('conference')->nullable();
            $table->unsignedBigInteger('balldontlie_team_id')->nullable();
            $table->string('division')->nullable();
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('abbreviation')->nullable();
            $table->index(['balldontlie_team_id'], 'balldontlie_team_index');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balldontlie_team');
    }
};

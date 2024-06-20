<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BalldontlieTeam>
 */
class BalldontlieTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'balldontlie_team_id' => 1000,
            "conference" => "East",
            "division" => "Central",
            "city" => fake()->city(),
            "name" => fake()->name(),
            "full_name" => fake()->name(),
            "abbreviation" => Str::upper(Str::random(3)),
        ];
    }
}

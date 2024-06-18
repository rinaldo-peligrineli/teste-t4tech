<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BalldontliesTeams>
 */
class BalldontliesTeamsFactory extends Factory
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
            "city" => "Chicago",
            "name" => fake()->city(),
            "full_name" => fake()->city(),
            "abbreviation" => Str::upper(Str::random(3)),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BalldontliePlayer>
 */
class BalldontliePlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

         return [
            "balldontlie_player_origin_id" => 1000,
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "position" => Str::upper(Str::random(1)) ."-" . Str::upper(Str::random(1)),
            "height" => "110",
            "weigth" => "190",
            "jersey_number" => rand(5, 15),
            "college" => "São Paulo FC",
            "country" => fake()->country(),
            "draft_year" => rand(2018, 2024),
            "draft_round" => rand(1, 10),
            "draft_number" => rand(1, 50)
        ];
    }
}

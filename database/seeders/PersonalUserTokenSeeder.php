<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonalUserToken;

class PersonalUserTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalUserToken::create(
            [
                'token_name' => 'Developer',
                'token_key' => '9dc44621-e11a-437e-a685-ef3d6089ced9'
            ]
        );
    }
}

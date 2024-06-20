<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\BalldontlieTeam;

class BalldontlieTeamTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

     public function testCanWithAuthorizationStoreTeam(): void
     {
        $teamData = BalldontlieTeam::factory()->raw();

        $header = $this->makeAuthAdmin();

        $response = $this->postJson('/api/balldontlies/teams', $teamData, $header);

        $response->assertCreated();

     }

     public function testWithoutAuthorizationCannotStoreTeam(): void
     {
         $teamData = BalldontlieTeam::factory()->raw();
         $header = $this->makeAuthAdmin(false);

         $response = $this->postJson('/api/balldontlies/teams', $teamData, $header);

         $response->assertUnauthorized();

     }

     public function testCanListTeam(): void
     {

        $header = $this->makeAuthAdmin();
        $response = $this->getJson('/api/balldontlies/teams', $header);
        $data = json_decode($response->getContent());

        $response->assertOK();
        $response->assertJsonStructure([
            'id',
            'conference',
            'division',
            'city',
            'name',
            'full_name',
            'abbreviation'
        ]);

     }

     public function testCanEditTeam(): void
     {
        $header = $this->makeAuthAdmin();
        $team = BalldontlieTeam::factory()->create();

        $response = $this->getJson('/api/balldontlies/teams/' . $team['id'], $header);

        $response->assertOk();
        $response->assertJsonCount(1);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'conference',
                'division',
                'city',
                'name',
                'full_name',
                'abbreviation'
            ]
        ]);

     }

     public function testCanDeleteTeam(): void
     {
        $header = $this->makeAuthAdmin();
        $team = BalldontlieTeam::factory()->create();

        $response = $this->deleteJson('/api/balldontlies/teams/delete/' . $team['id'], [], $header);

        $response->assertOk();

     }

     public function testCannotDeleteTeam(): void
     {
        $header = $this->makeAuthUser();
        $team = BalldontlieTeam::factory()->create();
        $response = $this->deleteJson('/api/balldontlies/teams/delete/' . $team['id'], [], $header);

        $response->assertStatus(403);


     }
}

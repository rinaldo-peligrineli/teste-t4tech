<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\BalldontliesTeams;

class BalldontlieTeamTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

     public function testCanWithAuthorizationStoreTeam(): void
     {
        $teamData = BalldontliesTeams::factory()->raw();

        $header = $this->makeAuthAdmin();

        $response = $this->postJson('/api/balldontlies/teams', $teamData, $header);

        $response->assertCreated();

     }

     public function testWithoutAuthorizationCannotStoreTeam(): void
     {
         $teamData = BalldontliesTeams::factory()->raw();
         $header = $this->makeAuthAdmin(false);

         $response = $this->postJson('/api/balldontlies/teams', $teamData, $header);

         $response
            ->assertUnauthorized();

     }

     public function testCanListTeam(): void
     {

        $header = $this->makeAuthAdmin();
        $response = $this->getJson('/api/balldontlies/teams', $header);
        $data = json_decode($response->getContent());

        $response->assertOK();

     }

     public function testCanEditTeam(): void
     {
        $header = $this->makeAuthAdmin();
        $team = BalldontliesTeams::factory()->create();

        $response = $this->getJson('/api/balldontlies/teams/' . $team['id'], $header);
        $data = json_decode($response->getContent());

        $response->assertOk()
            ->assertJsonCount(1);

     }

     public function testCanDeleteTeam(): void
     {
        $header = $this->makeAuthAdmin();
        $team = BalldontliesTeams::factory()->create();

        $response = $this->deleteJson('/api/balldontlies/teams/delete/' . $team['id'], [], $header);

        $response->assertOk();

     }

     public function testCannotDeleteTeam(): void
     {
        $header = $this->makeAuthUser();
        $team = BalldontliesTeams::factory()->create();
        $response = $this->deleteJson('/api/balldontlies/teams/delete/' . $team['id'], [], $header);

        $response->assertStatus(403);


     }
}

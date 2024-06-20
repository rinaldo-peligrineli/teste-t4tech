<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\BalldontliePlayer;

class BalldontliePlayerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

     public function testCanWithAuthorizationStorePlayer(): void
     {
        $playerData = BalldontliePlayer::factory()->raw();

        $header = $this->makeAuthAdmin();

        $response = $this->postJson('/api/balldontlies/players', $playerData, $header);

        $response->assertCreated();

     }

     public function testWithoutAuthorizationCannotStorePlayer(): void
     {
         $playerData = BalldontliePlayer::factory()->raw();
         $header = $this->makeAuthAdmin(false);

         $response = $this->postJson('/api/balldontlies/players', $playerData, $header);

         $response
            ->assertUnauthorized();

     }

     public function testCanListPlayer(): void
     {

        $header = $this->makeAuthAdmin();
        $response = $this->getJson('/api/balldontlies/players', $header);

        $response->assertOK();

     }

     public function testCanEditPlayer(): void
     {
        $header = $this->makeAuthAdmin();
        $player = BalldontliePlayer::factory()->create();

        $response = $this->getJson('/api/balldontlies/players/' . $player['id'] , $header);

        $response->assertOk()
            ->assertJsonCount(1);

     }

     public function testCanDeletePlayer(): void
     {
        $header = $this->makeAuthAdmin();
        $player = BalldontliePlayer::factory()->create();
        $response = $this->deleteJson('/api/balldontlies/players/delete/' . $player['id'], [], $header);
        $response->assertOk();

     }

     public function testCannotDeletePlayer(): void
     {
        $header = $this->makeAuthUser();
        $player = BalldontliePlayer::factory()->create();
        $response = $this->deleteJson('/api/balldontlies/players/delete/' . $player['id'], [], $header);

        $response->assertStatus(403);


     }
}

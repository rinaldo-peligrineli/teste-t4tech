<?php

namespace Tests\Unit;

use App\Models\BalldontliePlayer;
use Illuminate\Support\Str;

use Tests\TestCase;

class BalldontliePlayerModelTest extends TestCase
{

    /**
     * Set up operations
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

    }

    public function testForPlayerStore(): void
    {
       $playerFactory = BalldontliePlayer::factory()->raw();
       $player = BalldontliePlayer::create($playerFactory);
       $arrPlayer = json_decode($player,true);

       $this->assertArrayHasKey('id', $arrPlayer);
       $this->assertEquals(16, count($arrPlayer));

    }

    public function testForPlayerEditById(): void
    {

       $playerFactory = BalldontliePlayer::factory()->raw();
       $playerIns = BalldontliePlayer::create($playerFactory);
       $player = BalldontliePlayer::find($playerIns['id']);
       $arrPlayer = json_decode($player, true);

       $this->assertArrayHasKey('id', $arrPlayer);
       $this->assertEquals(16, count($arrPlayer));

    }

    public function testForPlayerUpdate(): void
    {
       $playerFactory = BalldontliePlayer::factory()->raw();

       $playerIns = BalldontliePlayer::create($playerFactory);
       $arrTeamIns = json_decode($playerIns,true);

       $player = BalldontliePlayer::find($arrTeamIns['id']);
       $arrTeamIns['name'] = $playerIns['name'] . fake()->lastName();
       unset($arrTeamIns['id']);
       $player->update($arrTeamIns);

       $arrPlayer = json_decode($player,true);

       $this->assertArrayHasKey('id', $arrPlayer);
       $this->assertEquals(16, count($arrPlayer));

    }

    public function testForPlayerDelete(): void
    {
       $playerFactory = BalldontliePlayer::factory()->raw();

       $playerIns = BalldontliePlayer::create($playerFactory);
       $arrPlayerIns = json_decode($playerIns,true);

       $player = BalldontliePlayer::find($arrPlayerIns['id']);
       $value = $player->delete();

       $this->assertNotNull($value);
       $this->assertTrue($value);

    }
}

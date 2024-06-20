<?php

namespace Tests\Unit;

use App\Models\BalldontlieTeam;
use Illuminate\Support\Str;

use Tests\TestCase;

class BalldontlieTeamModelTest extends TestCase
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

    public function testForTeamStore(): void
    {
       $teamFactory = BalldontlieTeam::factory()->raw();
       $team = BalldontlieTeam::create($teamFactory);
       $arrTeam = json_decode($team,true);

       $this->assertArrayHasKey('id', $arrTeam);
       $this->assertEquals(10, count($arrTeam));

    }

    public function testForTeamEditById(): void
    {

       $teamFactory = BalldontlieTeam::factory()->raw();
       $teamIns = BalldontlieTeam::create($teamFactory);
       $team = BalldontlieTeam::find($teamIns['id']);
       $arrTeam = json_decode($team, true);

       $this->assertArrayHasKey('id', $arrTeam);
       $this->assertEquals(11, count($arrTeam));

    }

    public function testForTeamUpdate(): void
    {
       $teamFactory = BalldontlieTeam::factory()->raw();

       $teamIns = BalldontlieTeam::create($teamFactory);
       $arrTeamIns = json_decode($teamIns,true);

       $team = BalldontlieTeam::find($arrTeamIns['id']);
       $arrTeamIns['name'] = $teamIns['name'] . fake()->lastName();
       unset($arrTeamIns['id']);
       $team->update($arrTeamIns);

       $arrTeam = json_decode($team,true);

       $this->assertArrayHasKey('id', $arrTeam);
       $this->assertEquals(11, count($arrTeam));

    }

    public function testForTeamDelete(): void
    {
       $teamFactory = BalldontlieTeam::factory()->raw();

       $teamIns = BalldontlieTeam::create($teamFactory);
       $arrTeamIns = json_decode($teamIns,true);

       $team = BalldontlieTeam::find($arrTeamIns['id']);
       $value = $team->delete();

       $this->assertNotNull($value);
       $this->assertTrue($value);

    }

}

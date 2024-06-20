<?php

namespace Tests\Unit;

use App\Http\Requests\Balldontlie\BalldontlieTeamUpdateRequest;
use Illuminate\Support\Str;

use Tests\TestCase;

class BalldontlieTeamUpdateRequestTest extends TestCase
{
    private $rules;
    private $validator;
        /**
     * Set up operations
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rules = (new BalldontlieTeamUpdateRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    public function testForTeamUpdateIsValidConference(): void
     {

        $this->assertTrue($this->validateField('conference', 'East'));
        $this->assertFalse($this->validateField('conference', ''));

     }

     public function testForTeamUpdateIsValidDivision(): void
     {

        $this->assertTrue($this->validateField('division', 'Central'));
        $this->assertFalse($this->validateField('division', ''));

     }

     public function testForTeamUpdateIsValidCity(): void
     {

        $this->assertTrue($this->validateField('city', fake()->city()));
        $this->assertFalse($this->validateField('city', ''));

     }

     public function testForTeamUpdateIsValidName(): void
     {

        $this->assertTrue($this->validateField('name', fake()->name()));
        $this->assertFalse($this->validateField('name', ''));

     }

     public function testForTeamUpdateIsValidFullName(): void
     {

        $this->assertTrue($this->validateField('full_name', fake()->name()));
        $this->assertFalse($this->validateField('full_name', ''));

     }

     public function testForTeamUpdateIsValidAbbreviation(): void
     {

        $this->assertTrue($this->validateField('abbreviation', Str::upper(Str::random(3))));
        $this->assertFalse($this->validateField('abbreviation', 'BOS'));
        $this->assertFalse($this->validateField('abbreviation', ''));

     }

    protected function validateField(string $field, $value): bool
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        )->passes();
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }


     public function testCanWithAuthorizationStoreUser(): void
     {

         $userData = User::factory()->raw();
         $header = $this->makeAuthAdmin();

         $response = $this->postJson('/api/users', $userData, $header);

         $response
            ->assertCreated()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
        ]);

     }

     public function testWithoutAuthorizationCannotStoreUser(): void
     {
         $userData = User::factory()->raw();
         $header = $this->makeAuthAdmin(false);

         $response = $this->postJson('/api/users', $userData, $header);

         $response
            ->assertUnauthorized();

     }

     public function testCanListUsers(): void
     {

        $header = $this->makeAuthAdmin();
        $response = $this->getJson('/api/users', $header);

        $response->assertOK();

     }

     public function testCanEditUser(): void
     {
        $header = $this->makeAuthAdmin();
        $user = User::factory()->create();

        $response = $this->getJson('/api/users/' . $user['id'], $header);

        $response->assertOk();
        $response->assertJsonCount(1);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at'
            ]
        ]);

     }

     public function testCanDeleteUser(): void
     {
        $header = $this->makeAuthAdmin();
        $user = User::factory()->create();

        $response = $this->deleteJson('/api/users/delete/' . $user['id'], [], $header);

        $response->assertOk()->assertJsonCount(1);

     }

     public function testCannotDeleteUser(): void
     {
        $header = $this->makeAuthUser();
        $user = User::factory()->create();
        $response = $this->deleteJson('/api/users/delete/' . $user['id'], [], $header);

        $response->assertStatus(403);


     }
}

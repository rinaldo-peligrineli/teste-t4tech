<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

    public function sign_in_role_user(): array
    {
        $userData = [
            'email' => 'user@t4tech-teste.com',
            'password' => 'user@1234'
        ];

        $response = $this->postJson('/api/auth', $userData);
        $data = json_decode($response->getContent());

        $headers = ['Authorization' => 'Bearer ' . $data->token];

        return $headers;

    }

     public function testCanWithAuthorizationStoreUser(): void
     {

         $userData = User::factory()->raw();
         $header = $this->MakeAuthAdmin();

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
         $header = $this->MakeAuthAdmin(false);

         $response = $this->postJson('/api/users', $userData, $header);

         $response
            ->assertUnauthorized();

     }

     public function testCanListUsers(): void
     {

        $header = $this->MakeAuthAdmin();
        $response = $this->getJson('/api/users', $header);
        $data = json_decode($response->getContent());

        $response->assertOK();

     }

     public function testCanEditUser(): void
     {
        $header = $this->MakeAuthAdmin();
        $user = User::factory()->create();

        $response = $this->getJson('/api/users/' . $user['id'], $header);
        $data = json_decode($response->getContent());

        $response->assertOk()
            ->assertJsonCount(1);

     }

     public function testCanDeleteUser(): void
     {
        $header = $this->MakeAuthAdmin();
        $user = User::factory()->create();

        $response = $this->deleteJson('/api/users/delete/' . $user['id'], [], $header);

        $response->assertOk()->assertJsonCount(1);

     }

     public function testCannotDeleteUser(): void
     {
        $header = $this->makeAuthUser();
        $user = User::factory()->create();
         $response = $this->deleteJson('/api/users/delete/' . $user['id'], [], $header);
         $data = json_decode($response->getContent());

         $response->assertStatus(403);


     }
}

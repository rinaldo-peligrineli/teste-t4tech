<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function sign_in(): array
    {

        $userData = [
            'email' => 'admin@t4tech-teste.com',
            'password' => 'admin@1234'
        ];

        $response = $this->postJson('/api/auth', $userData);
        $data = json_decode($response->getContent());


        $headers = ['Authorization' => 'Bearer ' . $data->token];

        return $headers;

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

         $header = $this->sign_in();
         $header['X-Authorization'] = '9dc44621-e11a-437e-a685-ef3d6089ced9';

         $response = $this->postJson('/api/users', $userData, $header);

         $response
            ->assertCreated();

     }


     public function testWithoutAuthorizationCannotStoreUser(): void
     {
         $userData = User::factory()->raw();
         $response = $this->postJson('/api/users', $userData, $this->sign_in());

         $response
            ->assertUnauthorized();

     }

     public function testCanListUsers(): void
     {

         $header = $this->sign_in();
         $header['X-Authorization'] = '9dc44621-e11a-437e-a685-ef3d6089ced9';

         $response = $this->getJson('/api/users', $header);
         $data = json_decode($response->getContent());

         $response->assertOk();

     }

     public function testCanEditUser(): void
     {
         $header = $this->sign_in();
         $header['X-Authorization'] = '9dc44621-e11a-437e-a685-ef3d6089ced9';

         $response = $this->getJson('/api/users/1', $header);
         $data = json_decode($response->getContent());

         $response->assertOk()
            ->assertJsonCount(1);

     }

     public function testCanDeleteUser(): void
     {
         $header = $this->sign_in();
         $userData = User::factory()->raw();


         $header['X-Authorization'] = '9dc44621-e11a-437e-a685-ef3d6089ced9';

         $response = $this->deleteJson('/api/users/delete/4', [], $header);

         $response->assertOk()->assertJsonCount(1);

     }

     public function testCannotDeleteUser(): void
     {
         $header = $this->sign_in_role_user();
         $header['X-Authorization'] = '9dc44621-e11a-437e-a685-ef3d6089ced9';

         $response = $this->deleteJson('/api/users/delete/4', [], $header);
         $data = json_decode($response->getContent());

         $response->assertStatus(403);


     }
}

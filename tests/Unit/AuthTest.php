<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{

     public function test_it_can_be_login(): void
     {

         $userData = [
             'email' => 'admin@t4tech-teste.com',
             'password' => 'admin@1234'
         ];

         $response = $this->postJson('/api/auth', $userData);

         $response
            ->assertStatus(200);

     }

     public function test_not_can_be_login(): void
     {

         $userData = [
             'email' => 'admin@t4tech-teste.com',
             'password' => 'admin@1235'
         ];

         $response = $this->postJson('/api/auth', $userData);

         $response
            ->assertUnauthorized();

     }

     public function test_it_can_be_logout(): void
     {
        $userData = [
            'email' => 'admin@t4tech-teste.com',
            'password' => 'admin@1234'
        ];

        $response = $this->postJson('/api/auth', $userData);
        $data = json_decode($response->getContent());
        $headers = ['Authorization' => 'Bearer ' . $data->token];
        $response = $this->postJson('/api/auth/logout', [], $headers);
        $response->assertOK();
     }
}

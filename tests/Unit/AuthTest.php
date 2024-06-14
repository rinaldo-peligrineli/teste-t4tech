<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{

     public function testCanBeMakeLogin(): void
     {

         $userData = [
             'email' => 'admin@t4tech-teste.com',
             'password' => 'admin@1234'
         ];

         $response = $this->postJson('/api/auth', $userData);

         $response->assertOK();
         $response->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at'

            ],
            'token'
        ]);

     }

     public function testCannotMakelogin(): void
     {

         $userData = [
             'email' => 'admin@t4tech-teste.com',
             'password' => 'admin@1235'
         ];

         $response = $this->postJson('/api/auth', $userData);

         $response
            ->assertUnauthorized();

     }

     public function testCanMakeLogout(): void
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

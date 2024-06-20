<?php

namespace Tests\Feature;

use Tests\TestCase;
class AuthTest extends TestCase
{

     public function testCanBeMakeLogin(): void
     {

        $userData = [
            'email' => 'administrator@t4tech.com',
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

     public function testCannotMakeloginWithInvalidCredentials(): void
     {

        $userData = [
            'email' => 'admin@t4tech.com',
            'password' => 'admin@1234'
        ];

         $response = $this->postJson('/api/auth', $userData);

         $response
            ->assertUnauthorized();

     }

     public function testCanMakeLogout(): void
     {
        $headers = $this->makeAuthUser();
        $response = $this->postJson('/api/auth/logout', [], $headers);
        $response->assertOK();
     }
}

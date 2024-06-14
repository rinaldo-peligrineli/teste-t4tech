<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function makeAuthAdmin($isAddAuthorizationToken = true): array
    {
        $userData = [
            'email' => 'admin@t4tech-teste.com',
            'password' => 'admin@1234'
        ];

        $response = $this->postJson('/api/auth', $userData);
        $data = json_decode($response->getContent());

        if(!$isAddAuthorizationToken) {
            return $headers = [
                'Authorization' => 'Bearer ' . $data->token
            ];
        }

        $headers = [
            'Authorization' => 'Bearer ' . $data->token,
            'X-Authorization' => '9dc44621-e11a-437e-a685-ef3d6089ced9'
        ];


        return $headers;
    }

    public function makeAuthUser(): array
    {
        $userData = [
            'email' => 'user@t4tech-teste.com',
            'password' => 'user@1234'
        ];

        $response = $this->postJson('/api/auth', $userData);
        $data = json_decode($response->getContent());

        $headers = [
            'Authorization' => 'Bearer ' . $data->token,
            'X-Authorization' => '9dc44621-e11a-437e-a685-ef3d6089ced9'
        ];

        return $headers;
    }



}

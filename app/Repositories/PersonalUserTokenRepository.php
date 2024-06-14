<?php
namespace App\Repositories;

use App\Interfaces\PersonalUserTokenRepositoryInterface;
use App\Models\PersonalUserToken;

class PersonalUserTokenRepository implements PersonalUserTokenRepositoryInterface
{
    public function getTokenByKey($tokenKey)
    {
        return PersonalUserToken::where('token_key', $tokenKey)->first();
    }

}

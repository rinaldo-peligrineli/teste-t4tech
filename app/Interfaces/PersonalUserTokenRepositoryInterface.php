<?php

namespace App\Interfaces;

interface PersonalUserTokenRepositoryInterface
{
    public function getTokenByKey($tokenKey);
}

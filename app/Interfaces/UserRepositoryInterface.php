<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function getUserByEmail($email);
    public function searchUserByColumn($column, $value);
    public function deleteUser($id);
    public function createUser(array $userInfo);
    public function updateUser($id, array $newInfo);
}

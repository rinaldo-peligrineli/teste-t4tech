<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@t4tech-teste.com', 'password' => 'admin@1234'],
            ['name' => 'User', 'email' => 'user@t4tech-teste.com', 'password' => 'user3@1234'],
        ];

        foreach ($users as $user) {
            User::create(
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                 ]
            );

            if($user['name'] == 'Admin3') {
                $user = User::where('name', $user['name'])->first();
                $role = Role::where('name', 'admin')->first();

                $permissions = Permission::pluck('id', 'id')->all();

                $role->syncPermissions($permissions);

                $user->assignRole([$role->id]);
            }
        }
    }
}



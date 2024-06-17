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
        User::create(
            [
                'name' => 'Administrator',
                'email' => 'administrator@t4tech.com',
                'password' => 'admin@1234',
             ]
        );

        $user = User::where('email', 'administrator@t4tech.com')->first();
        $role = Role::where('name', 'admin')->first();

        $permissions = Permission::pluck('id', 'id')->where('name', 'admin-crud')->first();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        User::create(
            [
                'name' => 'User',
                'email' => 'user@t4tech.com',
                'password' => 'user@1234',
             ]
        );

        $user = User::where('email', 'user@t4tech.com')->first();
        $role = Role::where('name', 'user')->first();

        $permissions = Permission::pluck('id', 'id')->where('name', 'user-crud')->first();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);



        // $users = [
        //     ['name' => 'Admin', 'email' => 'admin@t4tech-teste.com', 'password' => 'admin@1234'],
        //     ['name' => 'User', 'email' => 'user@t4tech-teste.com', 'password' => 'user3@1234'],
        // ];

        // foreach ($users as $user) {
        //     User::create(
        //         [
        //             'name' => $user['name'],
        //             'email' => $user['email'],
        //             'password' => $user['password'],
        //          ]
        //     );

        //     if($user['name'] == 'Admin') {
        //         $user = User::where('name', $user['name'])->first();
        //         $role = Role::where('name', 'admin')->first();

        //         $permissions = Permission::pluck('id', 'id')->where('name', 'delete-registers')->first();

        //         $role->syncPermissions($permissions);

        //         $user->assignRole([$role->id]);
        //     }
        // }
    }
}



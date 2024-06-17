<?php

namespace App\Services;

use App\Interfaces\User\UserRepositoryInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserRoleAndPermissionService {

    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function saveUserWhithRoleAdmin($user, $bollUpdate): void {

        $userAdmin = $this->userRepository->getUserById($user->id);
        $roleAdmin = Role::where('name', 'admin')->first();
        $permissionAdmin = Permission::pluck('id', 'id')->where('name', 'admin-crud')->pluck('id','id');

        if($bollUpdate) {
            $user->assignRole([$roleAdmin->id]);
        }

        if(!$bollUpdate) {
            $roleAdmin->users()->attach($userAdmin);
        }

        $roleAdmin->syncPermissions($permissionAdmin);

    }

    public function saveUserWhithRoleUser($user, $bollUpdate): void {
        $userUser = $this->userRepository->getUserById($user->id);
        $roleUser = Role::where('name', 'user')->first();
        $permissionUser = Permission::where('name', 'user-crud')->pluck('id', 'id');

        if($bollUpdate) {
            $user->assignRole([$roleUser->id]);
        }

        if(!$bollUpdate) {
            $roleUser->users()->attach($userUser);
        }

        $roleUser->syncPermissions($permissionUser);
    }

    public function removeRolesAndPermissionsFromUser($id) {
        $userUpd = $this->userRepository->getUserById($id);

        $params = Permission::query()->whereIn('name', ['admin-crud', 'user-crud']);

        if ($params->count() !== 0) {
            $params = $params->pluck('id')->toArray();
            $userUpd->permissions()->detach();

            $userUpd
                ->revokePermissionTo('admin-crud')
                ->revokePermissionTo('user-crud');

            $userUpd->removeRole('admin');
            $userUpd->removeRole('user');


        }
    }
}

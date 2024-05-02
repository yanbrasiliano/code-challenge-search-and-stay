<?php

namespace App\Services\Permission;

use App\Models\User;

class PermissionService
{
    public function hasPermission(User $user, string $permissionName): bool
    {
        return $user->hasPermissionTo($permissionName);
    }
}

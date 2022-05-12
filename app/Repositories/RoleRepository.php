<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleRepository implements RoleRepositoryInterface
{
    public function all(): object
    {
        return Role::all();
    }

    public function getRoleById($id)
    {
        return Role::where('id', $id)->first();
    }

    public function permissions()
    {
        return Permission::all();
    }

    public function store($request)
    {
        $newRole = Role::create([
            'name' => $request->name,
            'vacations' => $request->vacations,
            'personal_days' => $request->personal_days,
            'sick_days' => $request->sick_days
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $newRole->syncPermissions($permissions);
    }

    public function update($id, $request)
    {
        $role = Role::where('id', $id)->first();
        $role->update([
            'name' => $request->name
        ]);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
    }
}

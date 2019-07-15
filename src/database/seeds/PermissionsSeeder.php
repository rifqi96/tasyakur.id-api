<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Declare module masters
        $modules = [
            'post',
            'role',
            'user',
            'taxonomy',
            'term'
        ];

        // Declare permission types
        $permissionTypes = [
            'view',
            'create',
            'update',
            'delete'
        ];

        // Declare the permissions
        $modulePermissions = collect();
        foreach ($modules as $module) {
            foreach ($permissionTypes as $pType) {
                $modulePermission = ['name' => "$pType-$module"];
                $modulePermissions->push($modulePermission);
                Permission::create($modulePermission);
            }
        }

        // Declare Superadmin permissions
        $superadminPermissions = Permission::all();
        if ($superadmin = Role::where('name', 'Superadmin')->firstOrFail())
            $superadmin->permissions()->attach($superadminPermissions);

        // Declare Admin permissions
        $adminPermissions = Permission::whereIn('name', array_filter($modulePermissions->all(), function($permission) {
            // Admin only can have post and user permissions
            $searchword = 'post|user';
            return preg_match("/$searchword/i", $permission['name']);
        }))->get();
        if ($admin = Role::where('name', 'Admin')->firstOrFail())
            $admin->permissions()->attach($adminPermissions);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Blog permissions
            'blogs.index',
            'blogs.show',
            'blogs.create',
            'blogs.store',
            'blogs.edit',
            'blogs.update',
            'blogs.destroy',

            // User permissions
            'users.index',
            'users.show',
            'users.create',
            'users.store',
            'users.edit',
            'users.update',
            'users.destroy',

            // Role permissions
            'roles.index',
            'roles.show',
            'roles.create',
            'roles.store',
            'roles.edit',
            'roles.update',
            'roles.destroy',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $customerRole = Role::firstOrCreate(['name' => 'Customers']);

        // Assign all permissions to Admin
        $allPermissions = Permission::all();
        $adminRole->syncPermissions($allPermissions);

        // Assign read-only permissions to Customers
        $customerPermissions = Permission::whereIn('name', [
            'blogs.index',
            'blogs.show',
            'users.index',
            'users.show',
        ])->get();

        $customerRole->syncPermissions($customerPermissions);
    }
}

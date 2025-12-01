<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'blog_read',
            'blog_write',
            'user_profile_read',
            'user_profile_write',
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Create roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $customer = Role::firstOrCreate(['name' => 'Customer']);

        // Assign permissions
        $admin->syncPermissions(Permission::all());
        $customer->syncPermissions(['blog_read']);

        // Create default admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'test@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $adminUser->assignRole($admin);

        // Optional: Create default customer user
        $customerUser = User::firstOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Customer',
                'password' => bcrypt('password'),
            ]
        );
        $customerUser->assignRole($customer);
    }
}

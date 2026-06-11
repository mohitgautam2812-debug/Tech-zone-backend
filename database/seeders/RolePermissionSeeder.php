<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'manage_users',
            'manage_products',
            'manage_orders',
            'manage_blogs',
            'manage_roles',
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        $admin = Role::create(['name' => 'admin']);
        $agent = Role::create(['name' => 'agent']);

        $admin->givePermissionTo($permissions);
        $agent->givePermissionTo(['manage_products']);
    }
}

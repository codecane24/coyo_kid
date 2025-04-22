<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $superadmin = Role::create(['name' => 'Superadmin']);
        $admin = Role::create(['name' => 'Admin']);
        $teacher = Role::create(['name' => 'Teacher']);
        $student = Role::create(['name' => 'Student']);

        $permissions = [
            'view all data',
            'view branch data',
            'manage students',
            'manage teachers',
            'view classes',
            'mark attendance',
            'view own data',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superadmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'view branch data',
            'manage students',
            'manage teachers',
        ]);

        $teacher->givePermissionTo([
            'view classes',
            'mark attendance',
        ]);

        $student->givePermissionTo([
            'view own data',
        ]);
    }
}

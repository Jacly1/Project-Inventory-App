<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $Operator = Role::create(['name' => 'Operator']);
        $adminbaak = Role::create(['name' => 'Admin Baak']);
        $adminkeuangan = Role::create(['name' => 'Admin Keuangan']);
        $mahasiswa = Role::create(['name' => 'Mahasiswa']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $Operator->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $adminbaak->givePermissionTo([
            'create-mahasiswa',
            'edit-mahasiswa',
            'delete-mahasiswa'
        ]);

        $adminkeuangan->givePermissionTo([
            'show-mahasiswa'
        ]);

        $mahasiswa->givePermissionTo([
            'edit-mahasiswa'
        ]);
    }
}
<?php

namespace Database\Seeders;

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
        $owner = Role::create(['name' => 'Owner']);
        $kepalagudang = Role::create(['name' => 'Kepala Gudang']);
        $staffproduksi = Role::create(['name' => 'Staff Produksi']);

        $owner->givePermissionTo([
            'create-masuk',
            'edit-masuk',
            'delete-masuk',
            'show-masuk',
            'create-stok',
            'edit-stok',
            'delete-stok',
            'show-stok',
            'create-keluar',
            'edit-keluar',
            'delete-keluar',
            'show-keluar',
            'show-notifikasi',
            'show-dashboard',
            'show-laporan'
        ]);

        $kepalagudang->givePermissionTo([
            'create-masuk',
            'edit-masuk',
            'delete-masuk',
            'show-masuk',
            'create-stok',
            'edit-stok',
            'delete-stok',
            'show-stok',
            'create-keluar',
            'edit-keluar',
            'delete-keluar',
            'show-keluar',
            'show-notifikasi',
            'show-dashboard',
            'show-laporan'
        ]);

        $staffproduksi->givePermissionTo([
            'show-stok'
        ]);
    }
}

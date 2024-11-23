<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run(): void
    {
    // Creating Super Admin User
    $superAdmin = User::create([
        'name' => 'Jacly',
        'email' => 'superadmin@roles.id',
        'password' => Hash::make('123456')
        ]);
    $superAdmin->assignRole('Super Admin');

        // Creating Owner User
        $admin = User::create([
        'name' => 'Hadi',
        'email' => 'owner@roles.id',
        'password' => Hash::make('123456')
        ]);
    $admin->assignRole('Owner');

        // Creating Kepala Gudang User
    $productManager = User::create([
        'name' => 'Selly',
        'email' => 'kepalagudang@roles.id',
        'password' => Hash::make('123456')
        ]);
    $productManager->assignRole('Kepala Gudang');

    // Creating Staff Produksi User
    $adminBaak = User::create([
        'name' => 'Cinta',
        'email' => 'staffproduksi@roles.id',
        'password' => Hash::make('123456')
        ]);
    $adminBaak->assignRole('Staff Produksi');
}}
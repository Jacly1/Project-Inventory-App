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
        'name' => 'Rivo',
        'email' => 'superadmin@roles.id',
        'password' => Hash::make('123456')
        ]);
    $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
        'name' => 'Meri',
        'email' => 'admin@roles.id',
        'password' => Hash::make('123456')
        ]);
    $admin->assignRole('Admin');

        // Creating Product Manager User
    $productManager = User::create([
        'name' => 'Fahri',
        'email' => 'operator@roles.id',
        'password' => Hash::make('123456')
        ]);
    $productManager->assignRole('Operator');

    // Creating Admin Baak
    $adminBaak = User::create([
        'name' => 'Andi',
        'email' => 'adminbaak@roles.id',
        'password' => Hash::make('123456')
        ]);
    $adminBaak->assignRole('Admin Baak');

    // Creating Admin Keuangan
    $adminKeuangn = User::create([
        'name' => 'Budi',
        'email' => 'adminkeuangan@roles.id',
        'password' => Hash::make('123456')
        ]);
    $adminKeuangn->assignRole('Admin Keuangan');
    // Creating Mahasiswa
    $mahasiswa = User::create([
        'name' => 'Charles',
        'email' => 'mahasiswa@roles.id',
        'password' => Hash::make('123456')
        ]);
    $mahasiswa->assignRole('Mahasiswa');
}}
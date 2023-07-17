<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{

    public function run()
    {
        $admin = User::create([
            'name' => 'Aris Maulana',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        $admin->assignRole('Admin');

        $penimbangan = User::create([
            'name' => 'User Penimbang',
            'email' => 'penimbang@gmail.com',
            'password' => bcrypt('password')
        ]);

        $penimbangan->assignRole('Penimbangan');


        $rekonsiliasi = User::create([
            'name' => 'User Rekonsiliasi',
            'email' => 'rekonsiliasi@gmail.com',
            'password' => bcrypt('password')
        ]);

        $rekonsiliasi->assignRole('Rekonsiliasi');

        $pengolahan = User::create([
            'name' => 'User Pengolahan',
            'email' => 'pengolahan@gmail.com',
            'password' => bcrypt('password')
        ]);

        $pengolahan->assignRole('Pengolahan');


        $container = User::create([
            'name' => 'User Container',
            'email' => 'container@gmail.com',
            'password' => bcrypt('password')
        ]);

        $container->assignRole('Container');


        $pengisian = User::create([
            'name' => 'User Pengisian',
            'email' => 'pengisian@gmail.com',
            'password' => bcrypt('password')
        ]);

        $pengisian->assignRole('Pengisian');

        $pengemasan = User::create([
            'name' => 'User Pengemasan',
            'email' => 'pengemasan@gmail.com',
            'password' => bcrypt('password')
        ]);

        $pengemasan->assignRole('Pengemasan');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            'Penimbangan',
            'Pengolahan',
            'Rekonsiliasi',
            'Container',
            'Pengisian',
            'Pengemasan',
            'Admin'
        ];

        foreach ($modules as $module => $permissions) {
            Permission::create([
                'name' => $permissions,
                'guard_name' => 'web',
            ]);
        }
    }
}

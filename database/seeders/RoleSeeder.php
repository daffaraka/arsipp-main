<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Penimbangan']);
        Role::create(['name' => 'Pengolahan']);
        Role::create(['name' => 'Rekonsiliasi']);
        Role::create(['name' => 'Container']);
        Role::create(['name' => 'Pengisian']);
        Role::create(['name' => 'Pengemasan']);
        Role::create(['name' => 'Admin']);

        $adminPermissions = [
            'Penimbangan', 'Pengolahan', 'Rekonsiliasi', 'Container', 'Pengisian', 'Pengemasan','Admin'
        ];

        $penimbangPermissions = [
            'Penimbangan'
        ];

        $rekonsiliasiPermissions = [
            'Rekonsiliasi'
        ];

        $pengolahanPermissions = [
            'Pengolahan'
        ];
        $containerPermissions = [
            'Container'
        ];
        $pengisianPermissions = [
            'Pengisian'
        ];

        $pengemasPermissions = [
            'Pengemasan'
        ];

        $adminRole = Role::where('name', 'Admin')->first();
        $adminRole->syncPermissions($adminPermissions);

        $penimbangRole = Role::where('name', 'Penimbangan')->first();
        $penimbangRole->syncPermissions([$penimbangPermissions]);

        $pengolahanRole = Role::where('name', 'Pengolahan')->first();
        $pengolahanRole->syncPermissions([$pengolahanPermissions]);

        $rekonsiliasiRole = Role::where('name', 'Rekonsiliasi')->first();
        $rekonsiliasiRole->syncPermissions([$rekonsiliasiPermissions]);

        $containerRole = Role::where('name', 'Container')->first();
        $containerRole->syncPermissions([$containerPermissions]);

        $pengisianRole = Role::where('name', 'Pengisian')->first();
        $pengisianRole->syncPermissions([$pengisianPermissions]);

        $pengemasanRole = Role::where('name', 'Pengemasan')->first();
        $pengemasanRole->syncPermissions([$pengemasPermissions]);
    }
}

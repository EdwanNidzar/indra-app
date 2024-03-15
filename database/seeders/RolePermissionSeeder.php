<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'karyawan']);
        Role::create(['name' => 'karyawan-operator']);
        Role::create(['name' => 'karyawan-admin']);
        Role::create(['name' => 'dosen']);
        Role::create(['name' => 'dosen-yayasan']);
        Role::create(['name' => 'dosen-pns']);
        Role::create(['name' => 'mahasiswa']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $karyawan_operator = User::create([
            'name' => 'Karyawan Operator',
            'nomor' => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
            'email' => 'operator@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $karyawan_operator->assignRole('karyawan-operator');

        $karyawan_admin = User::create([
            'name' => 'Karyawan Admin',
            'nomor' => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $karyawan_admin->assignRole('karyawan-admin');

        $dosen = User::create([
            'name' => 'Dosen',
            'nomor' => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $dosen->assignRole('dosen');

        $dosen_yayasan = User::create([
            'name' => 'Dosen Yayasan',
            'nomor' => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
            'email' => 'yayasan@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $dosen_yayasan->assignRole('dosen-yayasan');

        $dosen_pns = User::create([
            'name' => 'Dosen PNS',
            'nomor' => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
            'email' => 'pns@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $dosen_pns->assignRole('dosen-pns');

        $mahasiswa = User::create([
            'name' => 'Mahasiswa',
            'nomor' => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $mahasiswa->assignRole('mahasiswa');
    }
}

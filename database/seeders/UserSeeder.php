<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'id_periode' => 1,
        ]);
        $admin->assignRole('admin');

        $pembina = User::create(

            [
                'nama' => 'Rizka Sudarno',
                'email' => 'rizkasudarno@gmail.com',
                'password' => bcrypt('rizkasudarno123'),
                'id_periode' => 1,
            ],
            [
                'nama' => 'Fathia Hapsari',
                'email' => 'fathiahapsari@gmail.com',
                'password' => bcrypt('fathiahapsari123'),
                'id_periode' => 1,
            ]

        );
        $pembina->assignRole('pembina');

        $ketua = User::create([
            'nama' => 'Jeni Sulastri',
            'email' => 'jenisulastri@gmail.com',
            'id_univ' => 1,
            'id_divisi' => 1,
            'id_periode' => 2,
            'password' => bcrypt('jenisulastri123'),
        ]);
        $ketua->assignRole('ketua');

        $anggota = User::create([
            'nama' => 'Afif Surya Ramadhan',
            'email' => 'afifsuryaramadhan@gmail.com',
            'id_univ' => 1,
            'id_divisi' => 2,
            'id_periode' => 2,
            'password' => bcrypt('afifsuryaramadhan123'),
        ]);
        $anggota->assignRole('anggota');
    }
}

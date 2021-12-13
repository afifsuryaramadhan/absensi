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
            'status' => 'Aktif',
        ]);
        $admin->assignRole('admin');

        $pembina = User::create(

            [
                'nama' => 'Rizka Sudarno',
                'email' => 'rizkasudarno@gmail.com',
                'password' => bcrypt('rizkasudarno123'),
                'status' => 'Aktif',
            ],
            [
                'nama' => 'Fathia Hapsari',
                'email' => 'fathiahapsari@gmail.com',
                'password' => bcrypt('fathiahapsari123'),
                'status' => 'Aktif',
            ]

        );
        $pembina->assignRole('pembina');

        $ketua = User::create([
            'nama' => 'Jeni Sulastri',
            'email' => 'jenisulastri@gmail.com',
            'id_univ' => 1,
            'id_divisi' => 1,
            'tahun_ajar' => '2021',
            'status' => 'Aktif',
            'password' => bcrypt('jenisulastri123'),
        ]);
        $ketua->assignRole('ketua');

        $anggota = User::create([
            'nama' => 'Afif Surya Ramadhan',
            'email' => 'afifsuryaramadhan@gmail.com',
            'id_univ' => 1,
            'id_divisi' => 2,
            'tahun_ajar' => '2021',
            'status' => 'Aktif',
            'password' => bcrypt('afifsuryaramadhan123'),
        ]);
        $anggota->assignRole('anggota');
    }
}

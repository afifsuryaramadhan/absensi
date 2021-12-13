<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisi::insert([
            ['nama_divisi' => 'Kewirausahaan'],
            ['nama_divisi' => 'Pendidikan'],
            ['nama_divisi' => 'Kesehatan'],
            ['nama_divisi' => 'Lingkungan Hidup'],
            ['nama_divisi' => 'BPH']
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Univ;

class UnivSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Univ::insert([
            ['nama_univ' => 'Universitas Majalengka'],
            ['nama_univ' => 'Universitas Kuningan'],
            ['nama_univ' => 'Universitas Wiralodra'],
            ['nama_univ' => 'Institut Agam Islam Syekh Nurjati'],
            ['nama_univ' => 'IAI Bunga Bangsa Cirebon'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periode;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periode::insert([
            ['periode' => 'Pembina', 'status' => '1'],
            ['periode' => '2021/2022', 'status' => '1'],
        ]);
    }
}

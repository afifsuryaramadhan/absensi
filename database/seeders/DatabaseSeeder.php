<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UnivSeeder::class);
        $this->call(DivisiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PeriodeSeeder::class);
    }
}

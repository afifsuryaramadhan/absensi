<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Role,Permission,User -> Admin
        Permission::firstOrCreate(['name' => 'manajemen-role'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'manajemen-permission'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'manajemen-user'])->assignRole('admin');

        // Jadwal
        Permission::firstOrCreate(['name' => 'jadwal'])->assignRole('admin'); // list semua jadwal
        Permission::firstOrCreate(['name' => 'jadwal'])->assignRole('pembina'); // list semua jadwal
        Permission::firstOrCreate(['name' => 'jadwal'])->assignRole('ketua'); // list berdasarkan univ ketua
        Permission::firstOrCreate(['name' => 'jadwal'])->assignRole('anggota'); // list berdasarkan univ anggota

        Permission::firstOrCreate(['name' => 'jadwal-create'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'jadwal-create'])->assignRole('ketua');

        Permission::firstOrCreate(['name' => 'jadwal-edit'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'jadwal-edit'])->assignRole('ketua');

        Permission::firstOrCreate(['name' => 'jadwal-delete'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'jadwal-delete'])->assignRole('ketua');

        // Anggota
        Permission::firstOrCreate(['name' => 'anggota-list'])->assignRole('pembina'); // list semua anggota
        Permission::firstOrCreate(['name' => 'anggota-list'])->assignRole('ketua'); // list berdasarkan univ ketua
        Permission::firstOrCreate(['name' => 'anggota-create'])->assignRole('ketua');
        Permission::firstOrCreate(['name' => 'anggota-edit'])->assignRole('ketua'); //include change status user
        Permission::firstOrCreate(['name' => 'anggota-delete'])->assignRole('ketua');

        // Angkat & turunkan ketua
        Permission::firstOrCreate(['name' => 'ganti-ketua'])->assignRole('pembina');

        // Approve Absensi
        Permission::firstOrCreate(['name' => 'absensi-approve'])->assignRole('ketua');
        Permission::firstOrCreate(['name' => 'absensi-approve'])->assignRole('pembina');
        Permission::firstOrCreate(['name' => 'absensi-approve'])->assignRole('admin');

        // Eskport
        Permission::firstOrCreate(['name' => 'absensi-export'])->assignRole('ketua'); // data berdasarkan univ
        Permission::firstOrCreate(['name' => 'absensi-export'])->assignRole('admin');  // semua data

        Permission::firstOrCreate(['name' => 'absensi-list'])->assignRole('ketua');  // berdasarkan univ
        Permission::firstOrCreate(['name' => 'absensi-list'])->assignRole('pembina');  // semua data
        Permission::firstOrCreate(['name' => 'absensi-list'])->assignRole('admin');  // semua data

        // Absen anggota
        Permission::firstOrCreate(['name' => 'absensi'])->assignRole('anggota'); // riwayat absensi masing2
        Permission::firstOrCreate(['name' => 'absensi-submit'])->assignRole('anggota');

        Permission::firstOrCreate(['name' => 'periode'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'periode-create'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'periode-edit'])->assignRole('admin');
        Permission::firstOrCreate(['name' => 'periode-delete'])->assignRole('admin');
    }
}

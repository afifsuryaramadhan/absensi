<?php

namespace App\Imports;

use App\Models\Univ;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Periode;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    protected $univ;
    protected $divisi;
    protected $periode;
    protected $role;


    public function __construct()
    {
        $this->univ = Univ::select('id', 'nama_univ')->get();
        $this->divisi = Divisi::select('id', 'nama_divisi')->get();
        $this->periode = Periode::select('id', 'periode')->get();
        $this->role = Role::select('id', 'name')->get();
    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        //make insert data to database here
        // $collection->each(function ($row) {
        //     $univ = $this->univ->where('nama_univ', $row['id_univ'])->first();
        //     $divisi = $this->divisi->where('nama_divisi', $row['id_divisi'])->first();
        //     $periode = $this->periode->where('id_periode', $row['id_periode'])->first();
        //     $user = User::create([
        //         'nama' => $row['nama'],
        //         'email' => $row['email'],
        //         'password' => bcrypt($row['password']),
        //         'id_univ' => $row['id_univ'],
        //         'id_divisi' => $row['id_divisi'],
        //         'id_periode' => $row['id_periode'],
        //     ]);
        //     $user->assignRole('anggota');
        //     $user->univ()->associate($univ);
        //     $user->divisi()->associate($divisi);
        //     $user->periode()->associate($periode);
        // });

        foreach ($collection as $row) {
            // $univ = $this->univ->where('nama_univ', $row['nama_univ'])->first();
            // $divisi = $this->divisi->where('nama_divisi', $row['nama_divisi'])->first();
            // $periode = $this->periode->where('periode', $row['periode'])->first();
            $data = [
                'nama' => $row['nama'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'id_univ' => Univ::where('nama_univ', $row['universitas'])->first()->id,
                'id_divisi' => Divisi::where('nama_divisi', $row['divisi'])->first()->id,
                'id_periode' => $row['id_periode'],
            ];

            $user = User::create($data);
            $user->assignRole('anggota');
        }
    }
    // (array $row)
    // {
    //     $univ = $this->univ->where('nama_univ', $row['nama_univ'])->first();
    //     $divisi = $this->divisi->where('nama_divisi', $row['nama_divisi'])->first();
    //     $periode = $this->periode->where('periode', $row['periode'])->first();

    //     return new User([
    //         "nama" => $row['nama'],
    //         "email" => $row['email'],
    //         "password" => bcrypt($row['password']),
    //         "id_univ" => $univ->nama_univ ?? NULL,
    //         "id_divisi" => $divisi->nama_divisi ?? NULL,
    //         "periode" => $periode->periode ?? NULL,

    //     ]);
    // }
}

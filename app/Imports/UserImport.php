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
        foreach ($collection as $row) {
            // $univ = $this->univ->where('nama_univ', $row['nama_univ'])->first();
            // $divisi = $this->divisi->where('nama_divisi', $row['nama_divisi'])->first();
            // $periode = $this->periode->where('periode', $row['periode'])->first();
            $data = [
                'nama' => $row['nama'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'id_univ' => $row['id_univ'],
                'id_divisi' => $row['id_divisi'],
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

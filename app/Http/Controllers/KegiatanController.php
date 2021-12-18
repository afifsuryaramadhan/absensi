<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Univ;
use App\Models\User;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    //
    public function index()
    {

        $role = auth()->user()->getRoleNames()->first();
        $user = auth()->user();
        // $this->authorize('akses_periode', User::class); //kondisi jika periode habis

        // Untuk anggota dan ketua dan sekretaris
        if (in_array(strtolower($role), ['anggota', 'ketua', 'sekretaris'])) {
            $kegiatan = Kegiatan::where('id_univ', $user->id_univ)->with([
                'univ',
                'absensi' => function ($q) use ($user) {
                    $q->where('id_user', $user->id);
                }
            ])->orderBy('id', 'DESC')
                ->get();
        } else {
            $kegiatan = Kegiatan::with('univ')->orderBy('id', 'DESC')->get();
        }

        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        $univ = Univ::all();
        return view('kegiatan.create', compact('univ'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal' => 'required',
        ]);

        if ($request->has('id_univ')) {
            $id_univ = $request->id_univ;
        } else {
            $id_univ = auth()->user()->id_univ;
        }

        $data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'id_univ' => $id_univ,
        ];

        Kegiatan::create($data);

        return redirect()->route('manajemen.kegiatan.index')->with('message', '<div class="alert alert-success my-3">Kegiatan baru berhasil ditambahkan.</div>');
    }

    public function edit($id)
    {
        $univ = Univ::all();
        $kegiatan = Kegiatan::where('id', $id)->first();
        return view('kegiatan.edit', compact('kegiatan', 'univ'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal' => 'required',
            'id_univ' => 'required',
        ]);

        $data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'id_univ' => $request->id_univ,
        ];
        Kegiatan::where('id', $id)->update($data);
        return redirect()->route('manajemen.kegiatan.index')->with('message', '<div class="alert alert-success my-3">Detail kegiatan berhasil diubah.</div>');
    }

    public function delete($id)
    {
        $kegiatan = Kegiatan::where('id', $id)->first();
        $kegiatan->delete();
        return redirect()->route('manajemen.kegiatan.index')->with('message', '<div class="alert alert-success my-3">Kegiatan ' . $kegiatan->nama_kegiatan . ' berhasil dihapus.</div>');
    }
}

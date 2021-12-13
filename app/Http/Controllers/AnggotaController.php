<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Univ;
use App\Models\Divisi;

class AnggotaController extends Controller
{
    public function index()
    {
        $currentUser = auth()->user();
        $role = $currentUser->getRoleNames()->first();

        if (strtolower($role) == 'ketua') {
            $users = User::whereHas('roles', function ($q) {
                $q->where('name', 'anggota')->orWhere('name', 'ketua')->orWhere('name', 'sekretaris');
            })->where('id_univ', $currentUser->id_univ)
                ->with('univ', 'divisi')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $users = User::whereHas('roles', function ($q) {
                $q->where('name', 'anggota')->orWhere('name', 'ketua')->orWhere('name', 'sekretaris');
            })->with('univ', 'divisi')
                ->orderBy('id', 'DESC')
                ->get();
        }

        return view('anggota.index', compact('users'));
    }

    public function create()
    {
        $univ = Univ::findOrFail(auth()->user()->id_univ);
        $divisi = Divisi::all();
        return view('anggota.create', compact('univ', 'divisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'tahun_ajar' => 'required',
            'id_divisi' => 'required',
            'status' => 'required',
        ]);


        try {
            $user = new User;

            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->tahun_ajar = $request->tahun_ajar;
            $user->id_univ = auth()->user()->id_univ;
            $user->id_divisi = $request->id_divisi;
            $user->status = $request->status;
            $user->save();

            $user->assignRole('anggota');
        } catch (Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">Input gagal divalidasi.</div>');
        }

        return redirect()->route('manajemen.anggota.index')->with('message', '<div class="alert alert-success my-3">User baru berhasil ditambahkan.</div>');
    }

    public function edit($id)
    {
        $univ = Univ::findOrFail(auth()->user()->id_univ);
        $divisi = Divisi::all();
        $user = User::findOrFail($id);
        return view('anggota.edit', compact('univ', 'divisi', 'user'));
    }

    public function show($id)
    {
        $user = User::with('univ', 'divisi')->findOrFail($id);
        $role = $user->getRoleNames()->first();
        return view('anggota.show', compact('user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'tahun_ajar' => 'required',
            'id_divisi' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'id_divisi' => $request->id_divisi,
            'tahun_ajar' => $request->tahun_ajar,
            'status' => $request->status,
        ];

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('manajemen.anggota.index')->with('message', '<div class="alert alert-success my-3">Data ' . $user->nama . ' berhasil diubah.</div>');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->route('manajemen.anggota.index')->with('message', '<div class="alert alert-success my-3">' . $user->nama . ' berhasil dihapus.</div>');
    }
}

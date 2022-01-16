<?php

namespace App\Http\Controllers;

use App\Models\Univ;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Periode;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
        $periode = Periode::all();
        $univ = Univ::findOrFail(auth()->user()->id_univ);
        $divisi = Divisi::all();
        $roles = Role::all();
        // $user = User::all();
        return view('anggota.create', compact('univ', 'divisi', 'periode', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'id_divisi' => 'required',
            'id_periode' => 'required',
        ]);


        try {
            $user = new User;

            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->id_univ = auth()->user()->id_univ;
            $user->id_divisi = $request->id_divisi;
            $user->id_periode = $request->id_periode;
            $user->save();

            $user->assignRole($request->role);
        } catch (Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">Input gagal divalidasi.</div>');
        }

        return redirect()->route('manajemen.anggota.index')->with('message', '<div class="alert alert-success my-3">User baru berhasil ditambahkan.</div>');
    }

    public function edit($id)
    {
        $periode = Periode::all();
        $univ = Univ::findOrFail(auth()->user()->id_univ);
        $divisi = Divisi::all();
        $user = User::findOrFail($id);
        return view('anggota.edit', compact('univ', 'divisi', 'user', 'periode'));
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
            'id_divisi' => 'required',
            'id_periode' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'id_divisi' => $request->id_divisi,
            'id_periode' => $request->id_periode,
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

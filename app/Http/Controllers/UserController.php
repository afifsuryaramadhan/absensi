<?php

namespace App\Http\Controllers;

use App\Models\Univ;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Periode;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('univ', 'divisi')
            ->orderBy('id', 'DESC')
            ->get();
        return view('manajemen-user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $univ = Univ::all();
        $divisi = Divisi::all();
        $periode = Periode::all();
        return view('manajemen-user.create', compact('univ', 'divisi', 'roles', 'periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_univ' => $request->id_univ,
            'id_divisi' => $request->id_divisi,
            'id_periode' => $request->id_periode,

        ];

        $user = User::create($data);
        $user->assignRole($request->role);

        return redirect()->route('manajemen.user.index')->with('message', '<div class="alert alert-success my-3">User baru berhasil ditambahkan.</div>');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $univ = Univ::all();
        $divisi = Divisi::all();
        $user = User::findOrFail($id);
        return view('manajemen-user.edit', compact('univ', 'divisi', 'user', 'roles'));
    }

    public function show($id)
    {
        $user = User::with('univ', 'divisi')->findOrFail($id);
        $role = $user->getRoleNames()->first();
        return view('manajemen-user.show', compact('user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'id_univ' => $request->id_univ,
            'id_divisi' => $request->id_divisi,
            'tahun_ajar' => $request->tahun_ajar,
            'status' => $request->status,
        ];

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('manajemen.user.index')->with('message', '<div class="alert alert-success my-3">Data ' . $user->nama . ' berhasil diubah.</div>');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->route('manajemen.user.index')->with('message', '<div class="alert alert-success my-3">' . $user->nama . ' berhasil dihapus.</div>');
    }
}

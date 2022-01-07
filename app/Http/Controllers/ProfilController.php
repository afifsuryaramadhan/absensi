<?php

namespace App\Http\Controllers;

use App\Models\Univ;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Periode;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::FindorFail(auth()->user()->id);
        $role = $user->getRoleNames()->first();
        return view('profil.index', compact('user', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        #
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $roles = Role::all();
        $univ = Univ::all();
        $divisi = Divisi::all();
        $periode = Periode::all();
        $user = User::findOrFail(auth()->user()->id);
        return view('profil.edit', compact('univ', 'divisi', 'user', 'roles', 'periode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:8|confirmed',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::FindorFail($id);
        $user->update($data);
        return redirect()->route('profil.index')->with('message', '<div class="alert alert-success my-3">Profil berhasil diperbarui.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::all();
        return view('periode.index', compact('periode'));
    }


    public function changeStatus(Request $Request)
    {
        $periode = Periode::find($Request->id);
        $periode->status = $Request->status;
        $periode->save();
        return response()->json(['success' => 'Status changed successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { {
            // $user = User::findOrFail(auth()->user()->id_univ);
            return view('periode.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'periode' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'periode' => $request->periode,
            'status' => $request->status,
        ];

        Periode::create($data);

        return redirect()->route('manajemen.periode.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $periode = Periode::find($id);
        $periode->delete();
        return redirect()->route('manajemen.periode.index')->with('message', '<div class="alert alert-success my-3">Periode baru berhasil dihapus.</div>');
    }
};

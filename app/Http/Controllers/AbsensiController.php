<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    //
    public function index()
    {
        // $this->authorize('periode', User::class); //batasi perilaku periode
        $user = auth()->user();
        $absensi = Absensi::where('id_user', $user->id)
            ->where('is_confirmed', 1)
            ->with('kegiatan')
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('absensi.index', compact('absensi'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png'
        ]);

        //save file image storage to public
        // $file = $request->file('foto');
        // $fileName = $file->getClientOriginalName();
        // $file->storeAs('public/foto', $fileName);

        $filename = \Str::random(9) . '_' . $request->foto->getClientOriginalName();
        $path = Storage::putFileAs('public/absensi', $request->foto, $filename);


        try {
            $absensi = new Absensi;

            $absensi->foto = $path;
            $absensi->is_confirmed = 0;
            $absensi->id_user = auth()->user()->id;
            $absensi->id_univ = auth()->user()->id_univ;
            $absensi->id_kegiatan = $request->id_kegiatan;

            $absensi->save();
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('message', '<div class="alert alert-danger my-3">Absensi gagal.</div>');
        }

        return redirect()->route('absensi.index')->with('message', '<div class="alert alert-success my-3">Absensi berhasil, menunggu konfirmasi ketua atau sekretaris</div>');
    }

    public function list()
    {

        $user = auth()->user();
        $role = auth()->user()->getRoleNames()->first();

        if (strtolower($role) == 'ketua') {
            $absensi = Absensi::where('id_univ', $user->id_univ)
                ->with('kegiatan', 'user')
                ->orderBy('updated_at', 'DESC')
                ->get();
        } else {
            $absensi = Absensi::with('kegiatan', 'user')
                ->orderBy('updated_at', 'DESC')
                ->get();
        }
        return view('absensi.list-absensi', compact('absensi'));
    }

    public function approve($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->update(['is_confirmed' => 1]);

        return redirect()->route('manajemen.absensi.index')->with('message', '<div class="alert alert-success my-3">Absensi berhasil dikonfirmasi</div>');
    }

    public function eksport()
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            $absensi = User::whereHas('roles', function ($q) {
                $q->whereName('anggota')->orWhere('name', 'ketua')->orWhere('name', 'sekretaris')->orWhere('name', 'bendahara');
            })->withCount('absensi as kehadiran')
                ->with([
                    'univ',
                    'absensi' => function ($q) {
                        return $q->where('is_confirmed', 1)->with('kegiatan');
                    }
                ])->get();
        } else {
            $absensi = User::whereHas('roles', function ($q) {
                $q->whereName('anggota')->orWhere('name', 'ketua')->orWhere('name', 'sekretaris')->orWhere('name', 'bendahara');
            })->where('id_univ', $user->id_univ)
                ->withCount('absensi as kehadiran')
                ->with([
                    'univ',
                    'absensi' => function ($q) {
                        return $q->where('is_confirmed', 1)->with('kegiatan');
                    }
                ])->get();
        }

        // return view('absensi.export', compact('absensi'));
        // // dd($absensi);
        $pdf = PDF::loadView('absensi.export', compact('absensi'));

        return $pdf->download('report-absensi.pdf');
    }
}

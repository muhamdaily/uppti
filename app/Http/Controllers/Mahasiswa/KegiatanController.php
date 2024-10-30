<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $kegiatans = Kegiatan::orderBy('created_at', 'desc')->get();
        } else {
            $kegiatans = Kegiatan::where('user_id', $user->id)->get();
        }

        return view('mahasiswa.kegiatan.index', compact('kegiatans'));
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
        $request->validate([
            'awal' => 'required',
            'akhir' => 'required',
            'kegiatan' => 'required'
        ]);

        Carbon::setLocale('id');

        $input = [
            'user_id' => auth()->user()->id,
            'nama' => auth()->user()->name,
            'hari' => now()->translatedFormat('l'),
            'tanggal' => now()->translatedFormat('d-m-Y'),
            'awal' => Carbon::createFromFormat('H:i', $request->awal)->format('H:i'),
            'akhir' => Carbon::createFromFormat('H:i', $request->akhir)->format('H:i'),
            'kegiatan' => $request->kegiatan
        ];

        Kegiatan::create($input);

        return back()->withToastSuccess('Berhasil Menambah Kegiatan Baru');
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
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'kegiatan' => 'required'
        ]);

        $kegiatan->update([
            'kegiatan' => $request->kegiatan
        ]);

        return back()->withToastSuccess('Berhasil Mengubah Kegiatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return back()->withToastSuccess('Berhasil Menghapus Kegiatan');
    }

    public function status(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $kegiatan->update([
            'status' => $request->status
        ]);

        return back()->withToastSuccess('Berhasil Mengubah Status Kegiatan');
    }
}

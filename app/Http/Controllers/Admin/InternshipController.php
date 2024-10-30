<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('nim', 'asc')->get();
        return view('admin.internship.index', compact('mahasiswas'));
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
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'email' => 'required'
        ]);

        $input = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ];

        if (Mahasiswa::create($input)) {
            return back()->withToastSuccess('Data berhasil ditambahkan');
        } else {
            return back()->withToastError('Data gagal ditambahkan');
        }
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
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'email' => 'required'
        ]);

        $data = $request->all();

        $mahasiswa->update($data);

        return back()->withToastSuccess('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return back()->withToastSuccess('Data berhasil dihapus');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $mahasiswa->email)->first();

        $input = [
            'name' => $mahasiswa->nama,
            'username' => $request->username,
            'email' => $mahasiswa->email,
            'email_verified_at' => now(),
            'password' => bcrypt($request->password)
        ];

        if (is_null($user)) {
            User::create($input);

            $mahasiswa->status = 'aktif';
            $mahasiswa->save();

            return back()->withToastSuccess('Akun Mahasiswa Berhasil Diaktifkan');
        } else {
            if ($user->username !== $request->username && User::where('username', $request->username)->exists()) {
                return back()->withErrors(['username' => 'Username already taken.']);
            }

            $user->name = $mahasiswa->nama;
            $user->email = $mahasiswa->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->save();

            return back()->withToastSuccess('Akun Mahasiswa Berhasil Diubah');
        }
    }
}

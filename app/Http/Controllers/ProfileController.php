<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $datas = User::where('name', $user->name)->get();
        } else {
            $datas = Mahasiswa::where('nama', $user->name)->get();
        }

        return view('profile.index', compact('datas'));
    }
}

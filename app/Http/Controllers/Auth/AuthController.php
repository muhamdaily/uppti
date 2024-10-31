<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.index')->withToastSuccess('Selamat Datang ' . auth()->user()->name);
            } else {
                return redirect()->route('user.index')->withToastSuccess('Selamat Datang ' . auth()->user()->name);
            }
        }

        return back()->withToastError('Kredensial yang diberikan tidak cocok dengan database kami.');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->withToastSuccess('Sesi kamu telah berakhir. Sampai jumpa kembali!');
    }
}

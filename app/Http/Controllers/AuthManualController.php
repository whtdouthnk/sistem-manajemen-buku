<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthManualController extends Controller
{

    public function index()
    {
        return view('manual-auth.login');
    }

    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Format Email harus benar!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            Alert::toast('Berhasil Login!', 'success')->autoClose(3000);
            return redirect()->route('dashboard'); 
   
        }
        Alert::toast('Username atau Password anda salah', 'error')->autoClose(3000);
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::toast('Anda telah logout', 'success')->autoClose(3000);
        return redirect()->route('homepage');

    }


}



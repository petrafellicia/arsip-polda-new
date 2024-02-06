<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Foundation\User\AuthenticatesUsers;
// use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function postLogin(Request $request)
    {
        //validasi
        Session::flash('username', $request->username);
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );
        //autentikasi
        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];



        if (Auth::attempt($infologin)) {
            // if (Auth::attempt($request->only('email', 'password'))) {
            //sukses
            return redirect('home')->with('Berhasil login');
        } else {
            //gagal
            return redirect('login')->withErrors('Username atau password tidak valid');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}

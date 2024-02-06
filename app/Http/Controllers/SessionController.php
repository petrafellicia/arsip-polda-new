<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    function index(){
        return view("session/index");
    }

    function login(Request $request){
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'reguired'
        ], 
        [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infologin)){
            //jika autentikasi sukses, 
            // return 'sukses';
            return redirect('mail')->with('success', 'Berhasil login');
        }
            else{
                //jika autentikasi gagal,
                // return 'gagal';
                return redirect('session')->withErrors('Invalid sername or password');
            }
    }

    function logout(){
        Auth::logout();
        return redirect('session')->with('success', 'Berhasil logout');
    }

}

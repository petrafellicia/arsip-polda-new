<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    //
    public function index()
    {
        return view('mails', [
            "title" => "Mails",
            //"mails" => Mail::all()
        ]);
    }

}
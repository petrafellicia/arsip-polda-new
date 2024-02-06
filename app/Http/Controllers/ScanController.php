<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sane\Sane;

class ScanController extends Controller
{
    //
    public function index()
    {
        return view('scan.index');
    }

    public function scan(Request $request)
    {
        $sane = new Sane();
        $devices = $sane->getDevices();

        if (count($devices) > 0) {
            $device = $devices[0];
            $sane->open($device);

            // Lakukan pemindaian
            $imageData = $sane->scan();
            
            $sane->close();

            // Lakukan sesuatu dengan data gambar, misalnya simpan atau tampilkan
            return view('scan.result', compact('imageData'));
        }

        return redirect('/scan')->with('error', 'Tidak ditemukan perangkat pemindai.');
    }
}

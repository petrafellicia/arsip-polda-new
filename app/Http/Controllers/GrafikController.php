<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GrafikController extends Controller
{
    public function grafikSurat(){
        $dailyDataMasuk = SuratMasuk::select(
            DB::raw("to_char(tanggal_surat, '"."%Y-%m"."') as month"),
            DB::raw('COUNT(*) as total_surat')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        $dailyDataKeluar = SuratKeluar::select(
            DB::raw("to_char(tanggal_surat, '"."%Y-%m"."') as month"),
            DB::raw('COUNT(*) as total_surat')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];

        foreach ($dailyDataMasuk as $data) {
            $months[] = $data->month;
        }

        $data = [
            'labels' => $months,
            'surat_masuk' => $dailyDataMasuk->pluck('total_surat'),
            'surat_keluar' => $dailyDataKeluar->pluck('total_surat')
        ];

        return view('home', [
            'title' => 'Home',
            'data' => $data,
        ]);
    }
}

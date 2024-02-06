<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\KKA;
use App\Models\SuratKeluar;
use App\Models\SuratType;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\TujuanSurat;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
// use Yajra\DataTables\DataTables;

use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class SuratKeluarController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = SuratKeluar::query();
        $data = SuratKeluar::paginate(100);
        // dd($data);
        // $data = SuratKeluar::limit(5);
        return view(
            'suratkeluar',
            compact('data'),
            [
                "title" => "Daftar Surat Keluar"
            ]
        );
    }

    public function cari(Request $request)
    {
        $searchTerm = $request->search;
        $data = [];

        $data = SuratKeluar::where(function ($query) use ($searchTerm) {
            $query->where('no_surat', 'like', "%$searchTerm%")
                ->orWhere('tgl_surat', 'like', "%$searchTerm%")
                ->orWhere('kka', 'like', "%$searchTerm%")
                ->orWhereHas('pengirims', function ($query) use ($searchTerm) {
                    $query->where('nama_pengirim', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('penerimas', function ($query) use ($searchTerm) {
                    $query->where('nama_penerima', 'like', '%' . $searchTerm . '%');
                })
                ->paginate(100);
        })
            ->get();

        // if ($searchTerm) {
        //     $data = DB::table('surat_keluars')
        //         ->where('no_surat', $searchTerm)
        //         ->orWhere('tgl_surat', $searchTerm)
        //         ->orWhere('kka', $searchTerm)
        //         ->orWhere('pengirim', $searchTerm)
        //         ->orWhere('penerima', $searchTerm)
        //         ->orWhere('id_type', $searchTerm)
        //         ->paginate(5);
        // } else {
        //     $data = DB::table('surat_keluars')->paginate(5);
        // }
        $message = $data->isEmpty() ? "File tidak ditemukan" : "";

        return view(
            'suratkeluar',
            compact('data', 'message', 'searchTerm'),
            [
                "title" => "Daftar Surat Keluar"
            ]
        );

    }

    public function tambahsuratkeluar()
    {
        // $datasurat = SuratType::all();
        $datapengirim = Unit::all();
        $datapenerima = TujuanSurat::all();
        $jenis_surat = JenisSurat::all();
        $kka = KKA::all();
        return view('keluar', compact('datapengirim', 'datapenerima', 'jenis_surat', 'kka'));
    }

    public function insertsuratkeluar(Request $request)
    {
        // $disposisi = "";
        // for ($i = 0; $i < sizeof($request->get('disposisi')); $i++) {
        //     if ($request->get('disposisi')[$i] != null) {
        //         $disposisi .= $request->get('disposisi')[$i] . ";";
        //     }
        // }
        DB::beginTransaction();

        $asal_surat = Unit::where('nama_unit', $request->pengirim)->first();
        $jenis_surat = JenisSurat::where('nama', $request->jenis_surat)->first();
        $kka = KKA::where('nama', $request->kka)->first();

        if (empty($asal_surat)) {
            $asal_surat = Unit::create([
                'nama_pengirim' => $request->pengirim
            ]);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move('dokumensuratkeluar/', $filename);

            $data = SuratKeluar::create(
                [
                    'nomor_agenda' => $request->no_agenda,
                    'nomor_surat' => $request->no_surat,
                    'jenis_surat' => $jenis_surat->id,
                    'pengirim' => $asal_surat->id,
                    'perihal' => $request->perihal,
                    'kka' => $kka->id,
                    'dasar_surat' => $request->dasar_surat,
                    'tanggal_surat' => $request->tgl_surat,
                    'jam_surat' => $request->jam_surat,
                    'tujuan' => $request->penerima_id,
                    'feedback' => $request->feedback,
                    'file_name' => $filename
                ]
            );
        }
        DB::commit();
        Alert::success('Data Berhasil Disimpan', 'Data surat keluar telah berhasil disimpan ke database.')->toHtml();
        return redirect()->route('daftar-surat-keluar')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function download(Request $request, $file)
    {
        return response()->download(public_path('dokumensuratkeluar/' . $file));
    }

    public function simpan(Request $request)
    {
    }
    public function tampilkandatakeluar($id)
    {
        // $dataBaru1 = DB::table('surat_keluars')
        //     ->join('pengirims', 'surat_keluars.pengirim_id', '=', 'pengirims.id')
        //     ->select('surat_keluars.*', 'pengirims.nama_pengirim as sender_name')
        //     ->where('surat_keluars.id', $id)
        //     ->get();

        // $dataBaru2 = DB::table('surat_keluars')
        //     ->join('penerimas', 'surat_keluars.penerima_id', '=', 'penerimas.id')
        //     ->select('surat_keluars.*', 'penerimas.nama_penerima as receiver_name')
        //     ->where('surat_keluars.id', $id)
        //     ->get();

        // $datapengirim = Pengirim::all();
        // $datapenerima = Penerima::all();
        // // dd($dataBaru);
        // $data = $dataBaru1[0];
        // $data = $dataBaru2[0];
        $jenis_surat = JenisSurat::all();
        $pengirim = Unit::all();
        $penerima = TujuanSurat::all();
        $kka = KKA::all();
        $data = SuratKeluar::where('id', $id)->first();
        return view('tampildatakeluar', compact('data', 'jenis_surat', 'pengirim', 'penerima', 'kka'));

        // $data = SuratKeluar::find($id);
        // $datasurat = SuratType::all();
        // // dd($data);
        // dd($datasurat);
        // return view('tampildatakeluar', compact('data', 'datasurat'));

    }

    public function updatedatakeluar(Request $request, $id)
    {
        $data = SuratKeluar::find($id);
        // $disposisi = "";
        // for ($i = 0; $i < sizeof($request->get('disposisi')); $i++) {
        //     if ($request->get('disposisi')[$i] != null) {
        //         $disposisi .= $request->get('disposisi')[$i] . ";";
        //     }
        // }

        $asal_surat = Unit::where('nama_unit', $request->pengirim)->first();
        $jenis_surat = JenisSurat::where('nama', $request->jenis_surat)->first();
        $kka = KKA::where('nama', $request->kka)->first();

        if (empty($asal_surat)) {
            $asal_surat = Unit::create([
                'nama_pengirim' => $request->pengirim
            ]);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move('dokumensuratkeluar/', $filename);
            $data->update(
                [
                    'nomor_agenda' => $request->no_agenda,
                    'nomor_surat' => $request->no_surat,
                    'jenis_surat' => $jenis_surat->id,
                    'pengirim' => $asal_surat->id,
                    'perihal' => $request->perihal,
                    'kka' => $kka->id,
                    'dasar_surat' => $request->dasar_surat,
                    'tanggal_surat' => $request->tgl_surat,
                    'jam_surat' => $request->jam_surat,
                    'tujuan' => $request->penerima_id,
                    'feedback' => $request->feedback,
                    'file_name' => $filename
                ]
            );

        }
        Alert::success('Data Berhasil DiUpdate', 'Data surat keluar telah berhasil diupdate ke database.')->toHtml();
        return redirect('/daftar-surat-keluar');
    }

    public function deletekeluar($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        if (!$suratKeluar) {
            Alert::error('Data tidak ditemukan', 'Data dengan ID yang diberikan tidak ditemukan.');
        } else {
            $file = SuratKeluar::find($id)->file_name;
            if (file_exists(public_path('dokumensuratkeluar/' . $file))) {
                unlink(public_path('dokumensuratkeluar/' . $file));
            }
            $suratKeluar->delete();
            Alert::success('Data Berhasil Dihapus', 'Data surat keluar telah berhasil dihapus dari database.')->toHtml();
        }
        return redirect()->back()->with('success', 'Data surat keluar berhasil dihapus.');
    }

    public function destroy($id)
    {
        $hapus = SuratKeluar::findorfail($id);

        $file = public_path('/dokumensuratkeluar') . $hapus->gambar;
        if (file_exists($file)) {
            @unlink($file);
        }

        $hapus->delete();
        return back();

    }

    public function showForm()
    {
        return view('pilih-bulan-keluar');
    }

    public function exportpdfkeluar(Request $request)
    {
        $bulan = $request->input('bulan');
        $data = SuratKeluar::whereMonth('tanggal_surat', $bulan)->get();

        $pdf = PDF::loadView('cetaksuratkeluar', ['data' => $data, 'bulan' => $bulan]);

        return $pdf->download('suratkeluar' . $bulan . '.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\KKA;
use App\Models\Mail;
use App\Models\SuratMasuk;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Collection;
use PDF;

// use Alert;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $data = SuratMasuk::query();

        // if ($request->has('nomor_surat')){
        //     $query->where('nomor_surat', 'LIKE', '%' . $request->nomor_surat . '%')->paginate(5);
        // }
        // if ($request->has('tanggal_surat')){
        //     $query->whereDate('tanggal_surat', 'LIKE', '%' . $request->tanggal_surat . '%')->paginate(5);
        // }
        // if($request->has('search')){
        //         $data = SuratMasuk::where('nomor_surat', 'LIKE', '%' .$request->search.'%')->paginate(5);
        //                             // ->orWhere('kka', 'LIKE', '%' .$request->search.'%')->paginate(5);
        // }
        // else{
        $data = SuratMasuk::paginate(100);
        // }
        return view(
            'suratmasuk',
            compact('data'),
            [
                "title" => "Daftar Surat Masuk"
            ]
        );
    }

    // public function cetakSuratMasuk(){
    //     $data=SuratMasuk::with('suratMasuk')->get();
    //     return view('cetakSuratMasuk', compact('data'));
    // }

    public function cari(Request $request)
    {
        $searchTerm = $request->search;
        $data = [];

        // if ($searchTerm) {
        //     $data = DB::select("SELECT * FROM surat_masuks WHERE nomor_surat = ? OR tanggal_surat = ? OR kka = ?", [$searchTerm, $searchTerm, $searchTerm]);
        // }

        // if ($searchTerm) {
        //     $data = DB::table('surat_masuks')
        //         ->where('nomor_surat', 'like', '%' . request('$searchTerm') . '%')
        //         ->orWhere('tanggal_surat', 'like', '%' . request('$searchTerm') . '%')
        //         ->orWhere('kka', 'like', '%' . request('$searchTerm') . '%')
        //         ->orWhere('pengirim', 'like', '%' . request('$searchTerm') . '%')
        //         ->orWhere('penerima', 'like', '%' . request('$searchTerm') . '%')
        //         ->orWhere('id_type', 'like', '%' . request('$searchTerm') . '%')
        //         ->paginate(5);
        // } else {
        //     $data = DB::table('surat_masuks')->paginate(5);
        // }
        // if ($searchTerm) {
        //     // $data = DB::table('surat_masuks')
        //     $data = SuratMasuk::where('nomor_surat', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('tanggal_surat', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('kka', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('pengirim', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('penerima', 'like', '%' . $searchTerm . '%')
        //         ->paginate(5);
        //     // $datasurat = SuratType::where('nama', 'like', '%' . $searchTerm . '%');
        // } else {
        //     // $data = DB::table('surat_masuks')->paginate(5);
        //     $data = SuratMasuk::paginate(5);
        // }
        $data = SuratMasuk::where(function ($query) use ($searchTerm) {
            $formattedSearchTerm = date('Y-m-d', strtotime($searchTerm));
            $query->where('nomor_surat', 'like', "%$searchTerm%")
                // ->orWhere('tanggal_surat', 'like', "%$searchTerm%")
                ->orWhereRaw("DATE_FORMAT(tanggal_surat, '%Y-%m-%d') LIKE ?", ["%$formattedSearchTerm%"])
                // ->orWhere('kka', 'like', "%$searchTerm%")
                ->orWhereHas('kka', function ($query) use ($searchTerm) {
                    $query->where('nama', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('asal_surat', function ($query) use ($searchTerm) {
                    $query->where('nama_pengirim', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('penerima', function ($query) use ($searchTerm) {
                    $query->where('nama_unit', 'like', '%' . $searchTerm . '%');
                })
                ->paginate(100);
        })
            ->get();

        $pesan = $data->isEmpty() ? "File tidak ditemukan" : "";

        return view(
            'suratmasuk',
            compact('data', 'pesan', 'searchTerm'),
            [
                "title" => "Daftar Surat Masuk"
            ]
        );
    }

    public function tambahdata()
    {
        $jenis_surat = JenisSurat::all();
        $unit_penerima = Unit::all();
        $kka = KKA::all();
        return view('masuk', compact('jenis_surat', 'unit_penerima', 'kka'), [
            "title" => "Input Surat Masuk"
        ]);
    }

    public function insertsurat(Request $request)
    {
        dump($request->all());
        $disposisi_kepada = "";
        for ($i = 0; $i < sizeof($request->get('disposisi')); $i++) {
            if ($request->get('disposisi')[$i] != null) {
                $disposisi_kepada .= $request->get('disposisi')[$i] . ";";
            }
        }
        // try {
        DB::beginTransaction();

        $penerima = Unit::where('nama_unit', $request->nama_unit)->first(); # penerima
        $asal_surat = Pengirim::where('nama_pengirim', strtolower($request->pengirim_id))->first();
        $jenis_surat = JenisSurat::where('nama', $request->jenis_surat)->first();
        $kka = KKA::where('nama', $request->kka)->first();
        if (empty($asal_surat)) {
            $asal_surat = Pengirim::create([
                'nama_pengirim' => strtolower($request->pengirim_id),
                'alamat_pengirim' => strtolower($request->pengirim_id)
            ]);
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move('dokumensuratmasuk/', $filename);
            $data = SuratMasuk::create(
                [
                    'nomor_agenda' => $request->nomor_agenda,
                    'nomor_surat' => $request->nomor_surat,
                    'jenis_surat' => $jenis_surat->id,
                    'asal_surat' => $asal_surat->id,
                    'perihal' => $request->perihal,
                    'kka' => $kka->id,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jam_surat' => $request->jam_terima,
                    'penerima' => $penerima->id,
                    'disposisi_kepada' => $disposisi_kepada,
                    'isi_disposisi' => $request->isi_disposisi,
                    'keterangan' => $request->keterangan,
                    'file_name' => $filename
                ]
            );
        }

        DB::commit();
        // return redirect()->route('daftar-surat-masuk')->with('success', 'Data Berhasil di Tambahkan');
        Alert::success('Data Berhasil Disimpan', 'Data surat masuk telah berhasil disimpan ke database.')->toHtml();
        return redirect('/daftar-surat-masuk');
        // } catch (\Throwable $th) {
        DB::rollBack();
        Alert::error('Data Gagal Disimpan', 'Data surat masuk gagal disimpan ke database.')->toHtml();
        return redirect()->back();
        // }
    }

    public function download(Request $request, $file)
    {
        return response()->download(public_path('dokumensuratmasuk/' . $file));
    }

    public function tampilkandatamasuk($id)
    {
        // $dataBaru1 = DB::table('surat_masuk')
        //     ->join('pengirims', 'surat_masuks.pengirim_id', '=', 'pengirims.id')
        //     ->select('surat_masuks.*', 'pengirims.nama_pengirim as sender_name')
        //     ->where('surat_masuks.id', $id)
        //     ->get();

        // $dataBaru2 = DB::table('surat_masuk')
        //     ->join('penerimas', 'surat_masuks.penerima_id', '=', 'penerimas.id')
        //     ->select('surat_masuks.*', 'penerimas.nama_penerima as receiver_name')
        //     ->where('surat_masuks.id', $id)
        //     ->get();

        // $datapengirim = Pengirim::all();
        // $datapenerima = Penerima::all();

        $jenis_surat = JenisSurat::all();
        $unit_penerima = Unit::all();
        $kka = KKA::all();

        $data = SuratMasuk::where('id', $id)->first();

        // $data = $dataBaru1[0];
        // $data = $dataBaru2[0];
        return view('tampildatamasuk', compact('data', 'jenis_surat', 'unit_penerima', 'kka'));

        // $dataBaru = DB::table('surat_masuks')
        //     ->join('surat_types', 'surat_masuks.id_type', '=', 'surat_types.id')
        //     ->select('surat_masuks.*', 'surat_types.nama as type_name')
        //     ->where('surat_masuks.id', $id)
        //     ->get();

        // $datasurat = SuratType::all();
        // // dd($dataBaru);
        // $data = $dataBaru[0];
        // return view('tampildatamasuk', compact('data', 'datasurat'));
        // $data = SuratMasuk::find($id);
        // $datasurat = SuratType::all();
        // return view('tampildatamasuk', compact('datasurat'), compact('data'));
    }

    public function updatedatamasuk(Request $request, $id)
    {
        $data = SuratMasuk::find($id);
        // if ($request->hasFile('file')) {
        //     $request->file('file')->move('dokumensuratmasuk/', $request->file('file')->getClientOriginalName());
        //     $data->file = $request->file('file')->getClientOriginalName();
        //     $data->save();
        $disposisi_kepada = "";
        for ($i = 0; $i < sizeof($request->get('disposisi')); $i++) {
            if ($request->get('disposisi')[$i] != null) {
                $disposisi_kepada .= $request->get('disposisi')[$i] . ";";
            }
        }
        try {
            DB::beginTransaction();
            $penerima = Unit::where('nama_unit', $request->nama_unit)->first(); # penerima
            $asal_surat = Pengirim::where('nama_pengirim', strtolower($request->pengirim_id))->first();
            $jenis_surat = JenisSurat::where('nama', $request->jenis_surat)->first();
            $kka = KKA::where('nama', $request->kka)->first();
            if (empty($asal_surat)) {
                $asal_surat = Pengirim::create([
                    'nama_pengirim' => strtolower($request->pengirim_id)
                ]);
            }
            $data->update(
                [
                    'nomor_agenda' => $request->nomor_agenda,
                    'nomor_surat' => $request->nomor_surat,
                    'jenis_surat' => $jenis_surat->id,
                    'asal_surat' => $asal_surat->id,
                    'perihal' => $request->perihal,
                    'kka' => $kka->id,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jam_surat' => $request->jam_terima,
                    'penerima' => $penerima->id,
                    'disposisi_kepada' => $disposisi_kepada,
                    'isi_disposisi' => $request->isi_disposisi,
                    'keterangan' => $request->keterangan,
                ]
            );

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $file->move('dokumensuratmasuk/', $filename);
                $data->file_name = $filename;
                $data->save();
            }
            DB::commit();
            Alert::success('Data Berhasil DiUpdate', 'Data surat masuk telah berhasil diupdate ke database.')->toHtml();
            return redirect('/daftar-surat-masuk');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Data Gagal DiUpdate', 'Data surat masuk gagal diupdate ke database.')->toHtml();
            return redirect('/daftar-surat-masuk');
        }

        // $data->update($request->all());
        // return redirect()->route('daftar-surat-masuk')->with('success', 'Data Berhasil di Update');

    }

    public function deletemasuk($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        if (!$suratMasuk) {
            Alert::error('Data tidak ditemukan', 'Data dengan ID yang diberikan tidak ditemukan.');
        } else {
            $file = SuratMasuk::find($id)->file_name;
            if (file_exists(public_path('dokumensuratmasuk/' . $file))) {
                unlink(public_path('dokumensuratmasuk/' . $file));
            }
            $suratMasuk->delete();
            Alert::success('Data Berhasil Dihapus', 'Data surat masuk telah berhasil dihapus dari database.')->toHtml();
        }
        return redirect()->back()->with('success', 'Data surat masuk berhasil dihapus.');

    }

    public function showForm()
    {
        return view('pilih-bulan-masuk');
    }

    public function exportpdfmasuk(Request $request)
    {
        $bulan = $request->input('bulan');
        $data = SuratMasuk::whereMonth('tanggal_surat', $bulan)->get();

        $pdf = PDF::loadView('cetaksuratmasuk', ['data' => $data, 'bulan' => $bulan]);

        return $pdf->download('suratmasuk' . $bulan . '.pdf');
    }

    // public function exportpdfmasuk(){
    //     $data = SuratMasuk::all();

    //     view()->share('data', $data);
    //     $pdf = PDF::loadview('cetaksuratmasuk');
    //     return $pdf->download('suratmasuk.pdf');

    // }

}

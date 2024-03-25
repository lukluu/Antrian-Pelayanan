<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Outlet;
use App\Models\Antrian;
use App\Models\Instansi;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        $instansis = Instansi::where('aktif', 1); // Mulai kueri dengan kondisi aktif = 1

        if ($request->has('sektor')) {
            $sektor = $request->sektor;
            $instansis->where('sektor', $sektor); // Menambahkan kondisi sektor jika parameter sektor disediakan
        }

        $instansis = $instansis->get(); // Menjalankan kueri dan mendapatkan hasilnya

        return view('ambil-antrian', [
            "title" => "Welcome | Ambil Antrian",
            "instansis" => $instansis,
        ]);
    }


    // public function resetNomorAntrian()
    // {
    //     // Mengecek apakah ada antrian baru yang diambil sejak reset terakhir
    //     $antrianMasuk = true; // Anda perlu menentukan cara untuk mengetahui apakah ada antrian yang masuk

    //     if ($antrianMasuk) {
    //         // Reset nomor antrian ke 1
    //         Cache::put('nomor_antrian', 1);
    //         Cache::put('last_reset_date', Carbon::now());
    //         // Mengembalikan respons yang sesuai
    //         return response()->json(['message' => 'Nomor antrian telah direset']);
    //     } else {
    //         // Tidak ada antrian yang masuk, tidak perlu melakukan reset
    //         return response()->json(['message' => 'Tidak ada antrian yang masuk']);
    //     }
    // }

    public function show(Request $request, $id)
    {
        $outlets = Outlet::with('instansi')->where('instansi_id', $id)->get();
        if ($outlets->isEmpty()) {
            return back()->with('info', 'Maaf, Belum Ada Layanan.');
        }
        $kodeInstansi = $outlets->first()->instansi->kode;
        $instansi = $outlets->first()->instansi->name;
        $sektor = $outlets->first()->instansi->sektor;

        // Mengambil tanggal terakhir kali nomor antrian direset
        $lastResetDate = Cache::get('last_reset_date');

        // Mengecek apakah tanggal hari ini berbeda dari tanggal terakhir reset
        if (!$lastResetDate || Carbon::now()->diffInDays($lastResetDate) > 0) {
            // Reset nomor antrian ke 1 jika tanggal hari ini berbeda dari tanggal terakhir reset
            $nomorAntrianBaru = 1;
            Cache::put('last_reset_date', Carbon::now());
        } else {
            // Menghitung jumlah antrian untuk kode instansi yang dipilih
            $jumlahAntrian = Antrian::whereHas('outlet', function ($query) use ($kodeInstansi) {
                $query->whereHas('instansi', function ($query) use ($kodeInstansi) {
                    $query->where('kode', $kodeInstansi);
                });
            })->count();

            // Tambah 1 ke nomor antrian untuk membuat nomor antrian baru
            $nomorAntrianBaru = $jumlahAntrian + 1;
        }

        // Membuat nomor antrian dengan format sesuai dengan kode instansi
        $nomorAntrian = $kodeInstansi . '-' . $nomorAntrianBaru;

        return view('keep', [
            "title" => "Welcome | Simpan Antrian",
            "pelayanans" => $outlets,
            'instansi' => $instansi,
            "nomor" => $nomorAntrian,
            "sektor" => $sektor,
        ]);
    }


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         "outlet_id" => "required",
    //         "no_antri" => "required",
    //         "status" => "required",
    //     ]);

    //     Antrian::create($validatedData);
    //     $antrianBaru = Antrian::latest()->first();
    //     $nomorAntrian = $antrianBaru->no_antri;
    //     Alert::success('Nomor Antrian Anda: ' . '<h1>' . $nomorAntrian . '</h1>' . 'Silahkan Di Foto')
    //         ->autoClose(30000);
    //     return back();
    // }


    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            "outlet_id" => "required",
            "no_antri" => "required",
            "status" => "required",
        ]);

        Antrian::create($validatedData);
        $antrianBaru = Antrian::latest()->first();
        $nomorAntrian = $antrianBaru->no_antri;

        Alert::success('Nomor Antrian Anda: ' . '<h1>' . $nomorAntrian . '</h1>' . '<h4>' . 'Silahkan di Foto/ Capture' . '</h4>')
            ->autoClose(30000);

        // Memasukkan skrip JavaScript ke dalam response untuk mencetak langsung
        $response = redirect()->back();
        $response->setContent('<script>window.onload = function() { window.print(); }</script>');
        return $response;
    }
}

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
    // public function show(Request $request, $id)
    // {
    //     $outlets = Outlet::with('instansi')->where('instansi_id', $id)->get();
    //     if ($outlets->isEmpty()) {
    //         return back()->with('info', 'Maaf, Belum Ada Layanan.');
    //     }

    //     // Retrieve the kode and name of the institution
    //     $kodeInstansi = $outlets->first()->instansi->kode;
    //     $instansi = $outlets->first()->instansi->name;
    //     $sektor = $outlets->first()->instansi->sektor;

    //     // Menghitung jumlah antrian untuk kode instansi yang dipilih
    //     $jumlahAntrian = Antrian::whereHas('outlet', function ($query) use ($kodeInstansi) {
    //         $query->whereHas('instansi', function ($query) use ($kodeInstansi) {
    //             $query->where('kode', $kodeInstansi);
    //         });
    //     })->count();

    //     // Tambah 1 ke nomor antrian untuk membuat nomor antrian baru
    //     $nomorAntrianBaru = $jumlahAntrian + 1;

    //     // Membuat nomor antrian dengan format sesuai dengan kode instansi
    //     $nomorAntrian = $kodeInstansi . '-' . $nomorAntrianBaru;

    //     return view('keep', [
    //         "title" => "Welcome | Simpan Antrian",
    //         "pelayanans" => $outlets,
    //         'instansi' => $instansi,
    //         "nomor" => $nomorAntrian,
    //         "sektor" => $sektor,
    //     ]);
    // }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "outlet_id" => "required",
            "no_antri" => "required",
            "status" => "required",
        ]);

        Antrian::create($validatedData);
        $antrianBaru = Antrian::latest()->first();
        $nomorAntrian = $antrianBaru->no_antri;
        Alert::success('Nomor Antrian Anda: ' . '<h1>' . $nomorAntrian . '</h1>')
            ->autoClose(20000);
        return back();
    }
}

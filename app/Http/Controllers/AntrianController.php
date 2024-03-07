<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Antrian;
use App\Models\Instansi;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianController extends Controller
{
    public function index()
    {
        $colors = [
            1 => 'info',   // Merah untuk gerai dengan id 1
            2 => 'success',  // Biru untuk gerai dengan id 2
            3 => 'warning', // Hijau untuk gerai dengan id 3
            4 => 'primary', // Hijau untuk gerai dengan id 3
            5 => 'secondary', // Hijau untuk gerai dengan id 3
            6 => 'danger', // Hijau untuk gerai dengan id 3
            7 => 'info', // Hijau untuk gerai dengan id 3
            8 => 'success', // Hijau untuk gerai dengan id 3
            // Tambahkan warna lainnya berdasarkan id gerai di sini
        ];
        $instansis = Instansi::all();
        return view('ambil-antrian', [
            "title" => "Welcome | Ambil Antrian",
            "colors" => $colors,
            "instansis" => $instansis,
        ]);
    }
    public function show(Request $request, $id)
    {
        $colors = [
            1 => 'info',   // Merah untuk gerai dengan id 1
            2 => 'success',  // Biru untuk gerai dengan id 2
            3 => 'warning', // Hijau untuk gerai dengan id 3
            4 => 'primary', // Hijau untuk gerai dengan id 3
            5 => 'secondary', // Hijau untuk gerai dengan id 3
            6 => 'danger', // Hijau untuk gerai dengan id 3
            7 => 'info', // Hijau untuk gerai dengan id 3
            8 => 'success', // Hijau untuk gerai dengan id 3
            // Tambahkan warna lainnya berdasarkan id gerai di sini
        ];

        $outlets = Outlet::with('instansi')->where('instansi_id', $id)->get();

        // Check if any outlets were found for the given institution
        if ($outlets->isEmpty()) {
            return back()->with('info', 'Maaf, Belum Ada Layanan.');
        }

        // Retrieve the kode and name of the institution
        $kodeInstansi = $outlets->first()->instansi->kode;
        $instansi = $outlets->first()->instansi->name;

        // Menghitung jumlah antrian untuk kode instansi yang dipilih
        $jumlahAntrian = Antrian::whereHas('outlet', function ($query) use ($kodeInstansi) {
            $query->whereHas('instansi', function ($query) use ($kodeInstansi) {
                $query->where('kode', $kodeInstansi);
            });
        })->count();

        // Tambah 1 ke nomor antrian untuk membuat nomor antrian baru
        $nomorAntrianBaru = $jumlahAntrian + 1;

        // Membuat nomor antrian dengan format sesuai dengan kode instansi
        $nomorAntrian = $kodeInstansi . '-' . $nomorAntrianBaru;

        return view('keep', [
            "title" => "Welcome | Simpan Antrian",
            "pelayanans" => $outlets,
            'instansi' => $instansi,
            "nomor" => $nomorAntrian,
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "outlet_id" => "required",
            "no_antri" => "required",
            "nik" => "required",
            "status" => "required",
            "nama" => "required",
            "no_hp" => "required",
            "gender" => "required",
            "pekerjaan" => "required",
            "alamat" => "required",
            "kelurahan" => "required",
            "kecamatan" => "required",
        ]);

        Antrian::create($validatedData);

        return back()->with('success', 'Berhasil Mengambil antrian');
    }
}

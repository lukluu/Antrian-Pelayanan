<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Antrian;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LayarController extends Controller
{
    public function index($instansiId)
    {
        // Mengambil informasi instansi
        $instansi = Instansi::findOrFail($instansiId);

        // Mengambil daftar outlet dari instansi
        $outlets = Outlet::where('instansi_id', $instansiId)->get();

        // Mengelompokkan antrian berdasarkan outlet dan mengambil antrian pertama untuk setiap outlet
        $antriansByOutlet = [];
        foreach ($outlets as $outlet) {
            $antriansByOutlet[$outlet->id] = Antrian::where('outlet_id', $outlet->id)
                ->where('status', 0) // Hanya ambil antrian yang belum selesai
                ->orderBy('created_at')
                ->first();
        }

        $title = $instansi->name;
        return view('layar.layar', compact('title', 'instansi', 'outlets', 'antriansByOutlet'));
    }




    public function instansi(Request $request, $instansiId)
    {
        // Mendapatkan tindakan yang diminta dari parameter 'action' di URL
        $action = $request->query('action');

        // Mengambil instansi sebelumnya dan berikutnya berdasarkan ID instansi saat ini
        $instansiSebelumnya = Instansi::where('id', '<', $instansiId)->orderBy('id', 'desc')->first();
        $instansiBerikutnya = Instansi::where('id', '>', $instansiId)->orderBy('id')->first();

        // Menentukan instansi baru berdasarkan tindakan
        if ($action === 'sebelumnya' && $instansiSebelumnya) {
            $instansiId = $instansiSebelumnya->id;
        } elseif ($action === 'berikutnya' && $instansiBerikutnya) {
            $instansiId = $instansiBerikutnya->id;
        }

        // Mengambil daftar outlet dari instansi baru
        $outlets = Outlet::where('instansi_id', $instansiId)->get();

        // Mengelompokkan antrian berdasarkan outlet dan mengambil antrian pertama untuk setiap outlet
        $antriansByOutlet = [];
        foreach ($outlets as $outlet) {
            $antriansByOutlet[$outlet->id] = Antrian::where('outlet_id', $outlet->id)
                ->where('status', 0) // Hanya ambil antrian yang belum selesai
                ->orderBy('created_at')
                ->first();
        }

        // Menghitung jumlah antrian yang masuk
        $jumlahAntrianMasuk = Antrian::whereHas('outlet', function ($query) use ($instansiId) {
            $query->where('instansi_id', $instansiId);
        })->where('status', 0)->count();

        // Menampilkan nomor antrian pertama yang diambil pertama kali untuk instansi baru
        $antrianPertama = Antrian::whereHas('outlet', function ($query) use ($instansiId) {
            $query->where('instansi_id', $instansiId);
        })->where('status', 0)->orderBy('created_at')->first();

        // Mengambil informasi instansi
        $instansi = Instansi::findOrFail($instansiId);

        $title = $instansi->name;
        return view('layar.layar', compact('title', 'instansi', 'outlets', 'antriansByOutlet', 'jumlahAntrianMasuk', 'antrianPertama', 'instansiSebelumnya', 'instansiBerikutnya'));
    }
}

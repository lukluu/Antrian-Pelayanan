<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Antrian;
use Illuminate\Http\Request;

class DashboardAntrianController extends Controller
{
    public function index(Request $request)
    {


        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $antrian = Antrian::with(['outlet', 'outlet.instansi'])
            ->where('status', 1)
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->get();

        // dd($antrian);
        return view('dashboard.antrian.index', [
            'title' => 'Dashboard | Antrian',
            'active' => 'antrian',
            'antrians' => $antrian,
        ]);
    }

    public function detail($id)
    {

        $antrian = Antrian::with(['outlet', 'outlet.instansi'])->findOrFail($id);

        $waktu_mulai = $antrian->waktu_mulai;
        $waktu_selesai = $antrian->waktu_selesai;
        if ($waktu_mulai && $waktu_selesai) {
            $waktuMulaiObj = new DateTime($waktu_mulai);
            $waktuSelesaiObj = new DateTime($waktu_selesai);

            $diff = $waktuSelesaiObj->getTimestamp() - $waktuMulaiObj->getTimestamp();

            // Menghitung menit dan detik
            $menit = floor($diff / 60);
            $detik = $diff % 60;

            // Format output
            $durasiMenitDetik = sprintf("%02d Menit %02d Detik", $menit, $detik);
        } else {
            $durasiMenitDetik = null;
        }
        return view('dashboard.antrian.detail', [
            'title' => 'Detail Antrian',
            'durasi' => $durasiMenitDetik,
            'antrian' => $antrian
        ]);
    }
}

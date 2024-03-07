<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        $user = Auth::user();

        $antrian = Antrian::with(['outlet', 'outlet.instansi'])->where('id', $user->id)->get();

        $antrianHariIni = Antrian::whereDate('created_at', Carbon::today())->get();
        $melayaniHariIni = Antrian::whereDate('created_at', Carbon::today())->where('status', 1)->count();
        $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $hariSekarang = $namaHari[date('w')];
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'antrian' => $antrian,
            'antrianaHariIni' => $antrianHariIni,
            'melayaniHariIni' => $melayaniHariIni,
            'jamSekarang' => $mytime->format('d-m-Y'),
            'hariSekarang' => $hariSekarang
        ]);
    }
}

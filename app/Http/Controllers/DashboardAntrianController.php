<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class DashboardAntrianController extends Controller
{
    public function index()
    {
        $antrian = Antrian::with('outlet')
            ->where('status', 1)
            ->get();

        // dd($antrian);
        return view('dashboard.antrian.index', [
            'title' => 'Dashboard | Antrian',
            'active' => 'antrian',
            'antrians' => $antrian,
        ]);
    }
}

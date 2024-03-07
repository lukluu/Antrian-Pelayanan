<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Antrian;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;

        $antrians = Antrian::whereHas('outlet', function ($query) use ($instansiId) {
            $query->where('instansi_id', $instansiId);
        })
            ->where('status', 0)
            ->get();

        $antrianData = $antrians->map(function ($antrian) {
            return [
                'id' => $antrian->id,
                'nomor_antrian' => $antrian->no_antri,
                'nama_layanan' => $antrian->outlet->nama_layanan, // Include service name
                'nama' => $antrian->nama,
                'nik' => $antrian->nik,
                'no_hp' => $antrian->no_hp,
                'tanggal_lahir' => $antrian->ttl,
                'gender' => $antrian->gender,
                'alamat' => $antrian->alamat,
                'kelurahan' => $antrian->kelurahan,
                'kecamatan' => $antrian->kecamatan,
                'pekerjaan' => $antrian->pekerjaan,
                'waktu_mulai' => $antrian->waktu_mulai,
                'waktu_pelayanan' => $antrian->created_at->diffForHumans()
            ];
        });

        $tunggu = $antrians->count();

        return view('user.dashboard.index', [
            'title' => 'Dashboard',
            'antrians' => $antrianData,
            'antrianMenunggu' => $tunggu
        ]);
    }



    public function selesai(Request $request)
    {
        $antrian = Antrian::findOrFail($request->antrian_id);
        $antrian->waktu_selesai = now();
        $antrian->status = 1;
        $antrian->save();
        return back();
    }
    public function layani(Request $request)
    {
        $antrian = Antrian::findOrFail($request->antrian_id);
        $antrian->waktu_mulai = now();
        $antrian->save();
        return back();
    }

    public function detail($id)
    {
        $antrian = Antrian::findOrFail($id);
        $nama_layanan = $antrian->outlet->nama_layanan;

        return view('user.dashboard.data-melayani', [
            'title' => 'Melayani',
            'id' => $antrian->id,
            'nomor_antrian' => $antrian->no_antri,
            'nama' => $antrian->nama,
            'nik' => $antrian->nik,
            'no_hp' => $antrian->no_hp,
            'tanggal_lahir' => $antrian->ttl,
            'gender' => $antrian->gender,
            'alamat' => $antrian->alamat,
            'kelurahan' => $antrian->kelurahan,
            'kecamatan' => $antrian->kecamatan,
            'pekerjaan' => $antrian->pekerjaan,
            'status' => $antrian->status,
            'waktu_pelayanan' => $antrian->created_at->diffForHumans(),
            'nama_layanan' => $nama_layanan
        ]);
    }




    public function terlayani()
    {
        $user = Auth::user();
        $instansiId = $user->instansi->id;

        $antrians = Antrian::whereHas('outlet', function ($query) use ($instansiId) {
            $query->whereHas('instansi', function ($query) use ($instansiId) {
                $query->where('instansi_id', $instansiId);
            });
        })
            ->where('status', 1) // Filter by status = 1 (served)
            ->get();

        $antrianData = $antrians->map(function ($antrian) {
            $waktu_mulai = $antrian->waktu_mulai ? Carbon::parse($antrian->waktu_mulai) : null;
            $waktu_selesai = $antrian->waktu_selesai ? Carbon::parse($antrian->waktu_selesai) : null;

            // Calculate the duration in minutes with fractions
            if ($waktu_mulai && $waktu_selesai) {
                $diffInSeconds = $waktu_mulai->diffInSeconds($waktu_selesai);
                $durasi = $diffInSeconds / 60; // Convert seconds to minutes
            } else {
                $durasi = null;
            }

            return [
                'id' => $antrian->id,
                'nomor_antrian' => $antrian->no_antri,
                'nama' => $antrian->nama,
                'nik' => $antrian->nik,
                'no_hp' => $antrian->no_hp,
                'tanggal_lahir' => $antrian->ttl,
                'gender' => $antrian->gender,
                'alamat' => $antrian->alamat,
                'kelurahan' => $antrian->kelurahan,
                'kecamatan' => $antrian->kecamatan,
                'pekerjaan' => $antrian->pekerjaan,
                'status' => $antrian->status,
                'durasi' => $durasi !== null ? number_format($durasi, 1) : null, // Format the duration with 1 decimal place
                'waktu_pelayanan' => $antrian->created_at
            ];
        });

        return view('user.dashboard.terlayani', [
            'title' => 'Data Pengunjung Terlayani',
            'antrians' => $antrianData,
        ]);
    }
}

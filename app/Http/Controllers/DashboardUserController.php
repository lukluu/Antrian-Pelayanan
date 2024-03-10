<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Survei;
use App\Models\Antrian;
use function Ramsey\Uuid\v1;
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
        $namaInstansi = $user->instansi->name;
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
            'antrianMenunggu' => $tunggu,
            'instansi' => $namaInstansi
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
        $user = auth()->user();
        $namaInstansi = $user->instansi->name;
        $nama_layanan = $antrian->outlet->nama_layanan;

        return view('user.dashboard.data-melayani', [
            'title' => 'Melayani',
            'id' => $antrian->id,
            'nomor_antrian' => $antrian->no_antri,
            'nama' => $antrian->nama,
            'nik' => $antrian->nik,
            'status' => $antrian->status,
            'waktu_pelayanan' => $antrian->created_at->diffForHumans(),
            'nama_layanan' => $nama_layanan,
            'instansi' => $namaInstansi,

        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string',
        ]);

        // Ambil data user berdasarkan ID
        $antrian = Antrian::findOrFail($id);
        $antrian->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
        ]);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return back()->with('success', 'Data Antrian berhasil diperbarui.');
    }


    public function survei()
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;
        $namaInstansi = $user->instansi->name;


        $surveis = Survei::whereHas('antrian', function ($query) use ($instansiId) {
            $query->whereHas('outlet', function ($query) use ($instansiId) {
                $query->where('instansi_id', $instansiId);
            })->where('survei', 1); // kondisi survei milik tabel antrians
        })
            ->with(['antrian', 'pertanyaan'])
            ->get();

        $namaLayanan = $surveis->pluck('antrian.outlet.nama_layanan')->unique();
        $layananPengunjung = Outlet::whereHas('antrians', function ($query) use ($instansiId) {
            $query->whereHas('outlet', function ($query) use ($instansiId) {
                $query->where('instansi_id', $instansiId);
            })->where('survei', 1); // kondisi survei milik tabel antrians
        })
            ->with(['antrians' => function ($query) use ($instansiId) {
                $query->whereHas('outlet', function ($query) use ($instansiId) {
                    $query->where('instansi_id', $instansiId);
                })->where('survei', 1); // kondisi survei milik tabel antrians
            }])
            ->withCount('antrians') // Menghitung jumlah antrians
            ->get();



        return view('user.survei.index', [
            'title' => 'Survei Pengunjung',
            'instansi' => $namaInstansi,
            'layananPengunjung' => $layananPengunjung,
        ]);
    }

    public function showSurvei($id)
    {
        $user = auth()->user();
        $namaInstansi = $user->instansi->name;
        return view('user.survei.detail-survei', [
            'title' => 'Detail Survei',
            'instansi' => $namaInstansi,

        ]);
    }

    public function terlayani(Request $request)
    {
        $user = Auth::user();
        $instansiId = $user->instansi->id;
        $namaInstansi = $user->instansi->name;

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $antrians = Antrian::whereHas('outlet', function ($query) use ($instansiId) {
            $query->whereHas('instansi', function ($query) use ($instansiId) {
                $query->where('instansi_id', $instansiId);
            });
        })
            ->where('status', 1) // Filter by status = 1 (served)
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
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
                'survei' => $antrian->survei,
                'durasi' => $durasi !== null ? number_format($durasi, 1) : null, // Format the duration with 1 decimal place
                'waktu_pelayanan' => $antrian->created_at
            ];
        });

        return view('user.dashboard.terlayani', [
            'title' => 'Data Pengunjung Terlayani',
            'antrians' => $antrianData,
            'instansi' => $namaInstansi
        ]);
    }


    public function setting()
    {
        $user = auth()->user();
        return view('user.dashboard.setting.index', [
            'title' => 'User Setting',
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'password' => $user->password,
            'instansi' => $user->instansi->name,
        ]);
    }
    public function editUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'max:255',
            'username' => 'max:255',
        ]);
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);
        $dataToUpdate = [];

        // Periksa apakah input 'name' diubah dan tambahkan ke array jika iya
        if ($request->has('name')) {
            $dataToUpdate['name'] = $request->name;
        }

        // Periksa apakah input 'username' diubah dan tambahkan ke array jika iya
        if ($request->has('username')) {
            $dataToUpdate['username'] = $request->username;
        }

        // Periksa apakah input 'password' diubah dan tambahkan ke array jika iya
        if ($request->has('password')) {
            $dataToUpdate['password'] = bcrypt($request->password);
        }

        // Perbarui data user dengan data yang telah ditentukan
        $user->update($dataToUpdate);

        return back()->with('success', 'Data User berhasil Diperbarui.');
    }
}

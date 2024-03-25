<?php

namespace App\Http\Controllers;

use DateTime;
use Dompdf\Dompdf;
use App\Models\Outlet;
use App\Models\Antrian;
use App\Models\Instansi;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardAntrianController extends Controller
{
    public function index(Request $request)
    {


        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $antrian = Antrian::with(['outlet', 'outlet.instansi'])
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->get();


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

    public function cetak()
    {
        return view('dashboard.antrian.cetak', [
            'title' => 'Cetak Antrian',
        ]);
    }
    public function showCetak(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'instansi' => 'nullable|exists:instansis,id',
            'nama_layanan' => 'nullable|exists:outlets,id',
            'jkl' => 'nullable|in:Laki-Laki,Perempuan',
            'pendidikan' => 'nullable|in:SD,SMP,SMA,DIII,S1,S2,S3',
            'survei' => 'nullable|in:1,0',
            'status' => 'nullable|in:1,0',
        ]);

        $antrianQuery = Antrian::with(['outlet', 'outlet.instansi'])
            ->when(isset($validatedData['instansi']), function ($query) use ($validatedData) {
                return $query->whereHas('outlet', function ($query) use ($validatedData) {
                    $query->where('instansi_id', $validatedData['instansi']);
                });
            })
            ->when(isset($validatedData['nama_layanan']), function ($query) use ($validatedData) {
                return $query->whereHas('outlet', function ($query) use ($validatedData) {
                    $query->where('id', $validatedData['nama_layanan']);
                });
            })
            ->when(isset($validatedData['start_date']), function ($query) use ($validatedData) {
                return $query->whereDate('created_at', '>=', $validatedData['start_date']);
            })
            ->when(isset($validatedData['end_date']), function ($query) use ($validatedData) {
                return $query->whereDate('created_at', '<=', $validatedData['end_date']);
            })
            ->when(isset($validatedData['jkl']), function ($query) use ($validatedData) {
                return $query->where('jkl', $validatedData['jkl']);
            })
            ->when(isset($validatedData['pendidikan']), function ($query) use ($validatedData) {
                return $query->where('pendidikan', $validatedData['pendidikan']);
            })
            ->when(isset($validatedData['survei']), function ($query) use ($validatedData) {
                return $query->where('survei', $validatedData['survei']);
            })
            ->when(isset($validatedData['status']), function ($query) use ($validatedData) {
                return $query->where('status', $validatedData['status']);
            });

        // Eksekusi query untuk mendapatkan data antrian
        $antrian = $antrianQuery->get()->toArray();
        $totalAntrianPerLayanan = [];
        foreach ($antrian as $antrianItem) {
            $instansiID = $antrianItem['outlet']['instansi']['id'];
            $layananNama = $antrianItem['outlet']['nama_layanan'];

            if (!isset($totalAntrianPerLayanan[$instansiID][$layananNama])) {
                $totalAntrianPerLayanan[$instansiID][$layananNama] = 1;
            } else {
                $totalAntrianPerLayanan[$instansiID][$layananNama]++;
            }
        }

        if (count($antrian) == 0) {

            return redirect('/dashboard/data-antrian/cetak')->with('warning', 'Data antrian tidak ditemukan');
        } else {
            return view('dashboard.antrian.layout', [
                'title' => 'Data Unduh',
                'antrians' => $antrian,
                'totalAntrianPerLayanan' => $totalAntrianPerLayanan,
                'instansi' => $request->input('instansi'),
            ]);
            // Data bukan array atau objek yang diharapkan, lakukan penanganan sesuai kebutuhan
        }
    }


    public function instansi()
    {
        $data = Instansi::where('name', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function layanan($id)
    {
        $data = Outlet::where('nama_layanan', 'LIKE', '%' . request('q') . '%')
            ->where('instansi_id', $id)
            ->get(); // Menambahkan ->get() untuk mengeksekusi query

        return response()->json($data);
    }
}

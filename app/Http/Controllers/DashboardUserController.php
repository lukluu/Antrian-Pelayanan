<?php

namespace App\Http\Controllers;

use Log;
use Excel;
use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Survei;

use App\Models\Antrian;
use App\Models\Instansi;
use App\Models\Pertanyaan;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\Cell;


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
                'waktu_pelayanan' => $antrian->created_at->diffForHumans(),
                'waktu' => $antrian->created_at,
            ];
        });

        $tunggu = $antrians->count();
        $outlets = Outlet::where('instansi_id', $instansiId)->get();
        return view('user.dashboard.index', [
            'title' => 'Dashboard',
            'antrians' => $antrianData,
            'antrianMenunggu' => $tunggu,
            'instansi' => $namaInstansi,
            'instansiId' => $instansiId,
            'outlets' => $outlets
        ]);
    }

    public function filterAntrian(Request $request)
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;
        $layananId = $request->layanan;
        $outlet = Outlet::find($layananId);
        if ($layananId == null) {
            return redirect('/user/dashboard');
        }
        $nama_layanan = $outlet->nama_layanan;

        $antrian = Antrian::whereHas('outlet', function ($query) use ($layananId) {
            $query->where('id', $layananId);
        })
            ->where('status', 0)
            ->get();

        $antrian_menunggu = $antrian->count();
        $outlets = Outlet::where('instansi_id', $instansiId)->get();

        $antrianData = $antrian->map(function ($antrian) {
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
                'waktu_pelayanan' => $antrian->created_at->diffForHumans(),
                'waktu' => $antrian->created_at,
            ];
        });

        return view('user.dashboard.filter', [
            'title' => 'Dashboard',
            'outlets' => $outlets,
            'nama_layanan' => $nama_layanan,
            'layananId' => $layananId,
            'antrianMenunggu' => $antrian_menunggu,
            'instansi' => $user->instansi->name,
            'antrians' => $antrianData
        ]);
    }

    public function detail($id)
    {
        $antrian = Antrian::findOrFail($id);
        $user = auth()->user();
        $namaInstansi = $user->instansi->name;
        $nama_layanan = $antrian->outlet->nama_layanan;
        $layananId = $antrian->outlet->id;
        return view('user.dashboard.data-melayani', [
            'title' => 'Melayani',
            'id' => $antrian->id,
            'nomor_antrian' => $antrian->no_antri,
            'nama' => $antrian->nama,
            'layananId' => $layananId,
            'nik' => $antrian->nik,
            'jkl' => $antrian->jkl,
            'pendidikan' => $antrian->pendidikan,
            'status' => $antrian->status,
            'waktu_pelayanan' => $antrian->created_at->diffForHumans(),
            'nama_layanan' => $nama_layanan,
            'instansi' => $namaInstansi,

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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jkl' => 'required|string',
            'pendidikan' => 'required|string',
        ]);

        // Ambil data user berdasarkan ID
        $antrian = Antrian::findOrFail($id);
        $antrian->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jkl' => $request->jkl,
            'pendidikan' => $request->pendidikan,
        ]);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return back()->with('success', 'Data Antrian berhasil diperbarui.');
    }


    public function survei()
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;
        $namaInstansi = $user->instansi->name;

        $layananPengunjung = Outlet::whereHas('antrians', function ($query) use ($instansiId) {
            $query->where('survei', 1); // kondisi survei milik tabel antrians
        })->where('instansi_id', $instansiId)
            ->withCount(['antrians' => function ($query) {
                $query->where('survei', 1); // kondisi survei milik tabel antrians
            }]) // Menghitung jumlah antrians dengan survei = 1
            ->get();



        return view('user.survei.index', [
            'title' => 'Survei Pengunjung',
            'instansi' => $namaInstansi,
            'layananPengunjung' => $layananPengunjung,
        ]);
    }


    public function showSurvei(Request $request, $id)
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;
        $outlet = Outlet::find($id);
        $namaInstansi = $user->instansi->name;
        $outlet_id = $outlet->id;
        $nama_layanan = $outlet->nama_layanan;

        // Check if the form has been submitted
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            // Get survey results based on date range and outlet
            $surveis = Survei::whereHas('antrian', function ($query) use ($outlet_id) {
                $query->where('outlet_id', $outlet_id);
            })
                ->whereBetween('created_at', [$start_date, $end_date])
                ->with(['antrian', 'pertanyaan'])
                ->get();

            // Group survey results by unique antrian IDs
            $groupedSurveis = $surveis->groupBy('antrian_id');

            // Initialize variables for total score and total questions
            $totalScore = 0;
            $totalQuestions = 0;
            $totalVisitors = $groupedSurveis->count(); // Total pengunjung

            // Initialize arrays for education and gender counts
            $totalEducation = [
                'SD' => 0,
                'SMP' => 0,
                'SMA' => 0,
                'DIII' => 0,
                'S1' => 0,
                'S2' => 0,
                'S3' => 0,
            ];
            $totalMale = 0;
            $totalFemale = 0;

            // Loop through each group
            foreach ($groupedSurveis as $antrianId => $surveiGroup) {
                // Calculate total score for each group
                $groupTotalScore = $surveiGroup->sum('skor');
                $totalScore += $groupTotalScore;

                // Get unique education and gender for each group
                $uniqueEducation = $surveiGroup->first()->antrian->pendidikan;
                $uniqueGender = $surveiGroup->first()->antrian->jkl;

                // Update education count
                if (array_key_exists($uniqueEducation, $totalEducation)) {
                    $totalEducation[$uniqueEducation]++;
                }

                // Update gender count
                if ($uniqueGender == 'Laki-Laki') {
                    $totalMale++;
                }
                if ($uniqueGender == 'Perempuan') {
                    $totalFemale++;
                }
                // Update total questions
                $totalQuestions += 9; // Assuming each antrian has 9 questions
            }

            // Calculate average score per question for all antrian groups
            $averageScorePerQuestion = ($totalQuestions > 0) ? ($totalScore / $totalQuestions) : 0;

            // Calculate final score (average score per question * 25)
            $finalScore = $averageScorePerQuestion * 25;

            // Kirimkan data pendidikan dengan format yang diinginkan ke tampilan
            $formattedEducation = [
                'SD' => $totalEducation['SD'],
                'SMP' => $totalEducation['SMP'],
                'SMA' => $totalEducation['SMA'],
                'DIII' => $totalEducation['DIII'],
                'S1' => $totalEducation['S1'],
                'S2' => $totalEducation['S2'],
                'S3' => $totalEducation['S3'],
            ];

            return view('user.survei.detail-survei', [
                'title' => 'Detail Survei',
                'surveis' => $surveis,
                'instansi' => $namaInstansi,
                'outlet_id' => $outlet_id,
                'nama_layanan' => $nama_layanan,
                'average_score' => $averageScorePerQuestion,
                'final_score' => round($finalScore, 1),
                'total_visitors' => $totalVisitors,
                'total_education' => $formattedEducation,
                'total_male' => $totalMale,
                'total_female' => $totalFemale,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'year' => date('Y'),
            ]);
        }

        // If the form hasn't been submitted yet, return the view with empty data
        $surveis = collect(); // Define an empty collection for $surveis
        return view('user.survei.detail-survei', [
            'title' => 'Detail Survei',
            'surveis' => $surveis,
            'instansi' => $namaInstansi,
            'outlet_id' => $outlet_id,
        ]);
    }


    public function unduhExcel(Request $request, $id)
    {
        // Mengambil survei yang sesuai dengan kriteria
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $surveis = Survei::with('antrian')
            ->whereHas('antrian', function ($query) use ($id) {
                $query->where('outlet_id', $id) // Filter antrian berdasarkan outlet_id
                    ->where('survei', 1); // Filter antrian dengan status survei 1
            })
            ->get();
        $instansi = $surveis->first()->antrian->outlet->instansi->name;

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Menyusun ulang data survei untuk menampung 1 kali setiap id antrian
        $dataAntrian = [];
        foreach ($surveis as $survei) {
            $antrianId = $survei->antrian->id;
            if (!isset($dataAntrian[$antrianId])) {
                $dataAntrian[$antrianId] = [
                    'antrian' => $survei->antrian,
                    'skor' => []
                ];
            }
            $dataAntrian[$antrianId]['skor'][] = $survei->skor;
        }

        // Membuat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menetapkan header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Nama Layanan');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Pendidikan');

        // Menambahkan header untuk 9 skor pertanyaan
        $column = 6;
        for ($i = 1; $i <= 9; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($column);
            $sheet->setCellValue($columnLetter . '1', "Pertanyaan " . $i);
            $column++;
        }

        // Mengisi data survei ke dalam spreadsheet
        $row = 2;
        foreach ($dataAntrian as $item) {
            $antrian = $item['antrian'];
            $sheet->setCellValue('A' . $row, $row - 1);
            $sheet->setCellValue('B' . $row, 'anonim');
            $sheet->setCellValue('C' . $row, $antrian->outlet->nama_layanan);
            $sheet->setCellValue('D' . $row, $antrian->jkl);
            $sheet->setCellValue('E' . $row, $antrian->pendidikan);

            // Menampilkan skor survei
            $skor = $item['skor'];
            $column = 6;
            foreach ($skor as $nilaiSkor) {
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($column);
                $cellCoordinate = $columnLetter . $row;
                $sheet->setCellValue($cellCoordinate, $nilaiSkor);
                $column++;
            }
            $row++;
        }

        // Mengatur header untuk diunduh sebagai file Excel
        // Mengatur header untuk diunduh sebagai file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_survei_' . $instansi . '_' . $antrian->outlet->nama_layanan . '_' . $start_date . '_' . $end_date . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Menyimpan file spreadsheet
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
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
                'gender' => $antrian->jkl,
                'status' => $antrian->status,
                'survei' => $antrian->survei,
                'durasi' => $durasi !== null ? number_format($durasi, 1) : null, // Format the duration with 1 decimal place
                'waktu_pelayanan' => $antrian->created_at,
                'nama_layanan' => $antrian->outlet->nama_layanan,
            ];
        });

        return view('user.dashboard.terlayani', [
            'title' => 'Data Pengunjung Terlayani',
            'antrians' => $antrianData,
            'instansi' => $namaInstansi
        ]);
    }

    public function detailTerlayani($id)
    {
        $user = Auth::user();
        $instansiId = $user->instansi->id;
        $namaInstansi = $user->instansi->name;
        $antrian = Antrian::whereHas('outlet', function ($query) use ($instansiId) {
            $query->whereHas('instansi', function ($query) use ($instansiId) {
                $query->where('instansi_id', $instansiId);
            });
        })
            ->where('status', 1)
            ->where('id', $id)
            ->first();

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

        return view('user.dashboard.detail-terlayani', [
            'title' => 'Detail Terlayani',
            'instansi' => $namaInstansi,
            'durasi' => $durasiMenitDetik,
            'antrian' => $antrian,
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


    public function syarat()
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;
        $namaInstansi = $user->instansi->name;

        $layanan = Outlet::with('instansi')->whereHas('instansi', function ($query) use ($instansiId) {
            $query->where('instansi_id', $instansiId);
        })->get();
        return view('user.dashboard.syarat', [
            'title' => 'Syarat Layanan',
            'instansi' => $namaInstansi,
            'layanan' => $layanan
        ]);
    }
    public function syaratEdit($id)
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;
        $namaInstansi = $user->instansi->name;
        $layanan = Outlet::with('instansi')->whereHas('instansi', function ($query) use ($instansiId) {
            $query->where('instansi_id', $instansiId);
        })->where('id', $id)->first();
        return view('user.dashboard.syarat-edit', [
            'title' => 'Syarat Layanan',
            'instansi' => $namaInstansi,
            'layanan' => $layanan
        ]);
    }
    public function syaratUpdate(Request $request, $id)
    {
        $layanan = Outlet::find($id);
        $layanan->update($request->all());
        return back()->with('success', 'Syarat Layanan Berhasilar Diperbarui');
    }

    public function showCetak()
    {
        $user = auth()->user();
        $instansiId = $user->instansi->id;
        $namaInstansi = $user->instansi->name;
        $layanan = Outlet::with('instansi')->whereHas('instansi', function ($query) use ($instansiId) {
            $query->where('instansi_id', $instansiId);
        })->get();

        // Pass an empty array for $antrians
        $antrians = [];

        return view('user.dashboard.show-cetak', [
            'title' => 'Cetak Laporan',
            'instansi' => $namaInstansi,
            'layanan' => $layanan,
            'antrians' => $antrians, // Pass an empty array here
        ]);
    }

    public function mulaiCetak(Request $request)
    {
        // Mendapatkan data pengguna yang saat ini login
        $user = auth()->user();

        // Mendapatkan ID instansi pengguna
        $instansiId = $user->instansi->id;

        // Mendapatkan data yang diperlukan dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $layananId = $request->input('nama_layanan');
        $jenisKelamin = $request->input('jkl');
        $pendidikan = $request->input('pendidikan');
        $statusSurvei = $request->input('survei');

        // Ambil data antrian dengan filter
        $query = Antrian::with('outlet')
            ->whereHas('outlet', function ($query) use ($instansiId) {
                $query->where('instansi_id', $instansiId); // Filter berdasarkan instansi pengguna
            });

        // Terapkan filter tambahan jika diberikan
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if ($layananId) {
            $query->where('outlet_id', $layananId);
        }
        if ($jenisKelamin) {
            $query->where('jkl', $jenisKelamin);
        }
        if ($pendidikan) {
            $query->where('pendidikan', $pendidikan);
        }
        if ($statusSurvei) {
            $query->where('survei', $statusSurvei);
        }

        // Ambil data antrian
        $antrians = $query->get();

        // Mendapatkan data instansi dan layanan
        $instansi = $user->instansi->name;
        $layanan = Outlet::with('instansi')->whereHas('instansi', function ($query) use ($instansiId) {
            $query->where('instansi_id', $instansiId);
        })->get();


        // Kembalikan view dengan data yang diperlukan
        return view('user.dashboard.show-cetak', [
            'title' => 'Cetak Laporan',
            'instansi' => $instansi,
            'layanan' => $layanan,
            'antrians' => $antrians,

            // Pass input sebelumnya ke view agar bisa ditampilkan kembali
            'start_date' => $startDate,
            'end_date' => $endDate,
            'layananId' => $layananId,
            'jenisKelamin' => $jenisKelamin,
            'pendidikan' => $pendidikan,
            'statusSurvei' => $statusSurvei,
        ]);
    }
}

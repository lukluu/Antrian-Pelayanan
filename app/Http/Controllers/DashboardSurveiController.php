<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Outlet;
use App\Models\Survei;
use App\Models\Instansi;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DashboardSurveiController extends Controller
{
    public function index(Request $request)
    {

        return view('dashboard.survei.index', [
            'title' => 'Dashboard | Survei',

        ]);
    }
    public function show(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'instansi' => 'required|exists:instansis,id',
            'nama_layanan' => 'required|exists:outlets,id',
        ]);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $outlet_id = $request->input('nama_layanan');
        $instansi_id = $request->input('instansi');
        $nama_instansi = Instansi::findOrFail($instansi_id)->name;
        $nama_outlet = Outlet::findOrFail($outlet_id)->nama_layanan;


        $surveis = Survei::whereHas('antrian', function ($query) use ($outlet_id) {
            $query->where('outlet_id', $outlet_id);
        })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->with(['antrian', 'pertanyaan'])
            ->get();

        if ($surveis->isEmpty()) {
            return redirect()->back()->with('info', 'Data Survei Tidak Ditemukan');
        }

        $groupedSurveis = $surveis->groupBy('antrian_id');


        // Calculate average scores for each unique survey ID
        $uniqueAverageScores = [];
        foreach ($groupedSurveis as $antrianId => $surveis) {
            $totalScore = 0;
            foreach ($surveis as $survei) {
                // Assuming 'skor' is the attribute containing the score for each question
                $totalScore += $survei->skor;
            }
            // Calculate average score per survey, then multiply by 25
            $averageScore = ($totalScore / 9) * 25;
            $uniqueAverageScores[$antrianId] = $averageScore;
        }

        // Calculate total of unique average scores
        $totalUniqueAverageScore = array_sum($uniqueAverageScores);

        // Calculate overall average score per unique survey ID
        $overallAverageScore = $totalUniqueAverageScore / count($uniqueAverageScores);
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
        foreach ($groupedSurveis as $antrianId => $surveiGroup) {
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
        }

        // Format data pendidikan sesuai keinginan
        $formattedEducation = [
            'SD' => $totalEducation['SD'],
            'SMP' => $totalEducation['SMP'],
            'SMA' => $totalEducation['SMA'],
            'DIII' => $totalEducation['DIII'],
            'S1' => $totalEducation['S1'],
            'S2' => $totalEducation['S2'],
            'S3' => $totalEducation['S3'],
        ];
        $earliestSurvey = $surveis->sortBy('created_at')->first();
        $latestSurvey = $surveis->sortByDesc('created_at')->first();

        $earliestTime = $earliestSurvey->created_at->format('d-m-Y');
        $latestTime = $latestSurvey->created_at->format('d-m-Y');

        return view('dashboard.survei.show', [
            'title' => 'Detail Survei',
            'surveis' => $surveis,
            'instansi' => $nama_instansi,
            'outlet_id' => $outlet_id,
            'nama_layanan' => $nama_outlet,
            'average_score' => $overallAverageScore, // Menggunakan skor rata-rata keseluruhan
            'final_score' => round($overallAverageScore, 1), // Jika final score sama dengan skor rata-rata
            'total_visitors' => $totalVisitors,
            'total_education' => $formattedEducation,
            'total_male' => $totalMale,
            'total_female' => $totalFemale,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'year' => date('Y'),
            'lama' => $earliestTime,
            'baru' => $latestTime
        ]);
    }

    public function cetakPdf(Request $request)
    {
        // Logika untuk mengambil data yang akan dicetak

        // Validasi request
        $validatedData = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'instansi' => 'required|exists:instansis,id',
            'nama_layanan' => 'required|exists:outlets,id',
        ]);

        // Ambil data dari request
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $outlet_id = $request->input('nama_layanan');

        // Query untuk mengambil data survei berdasarkan filter
        $surveis = Survei::whereHas('antrian.outlet', function ($query) use ($outlet_id) {
            $query->where('id', $outlet_id);
        })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->with(['antrian', 'pertanyaan'])
            ->get();
        $groupedSurveis = $surveis->groupBy('antrian_id');


        // Calculate average scores for each unique survey ID
        $uniqueAverageScores = [];
        foreach ($groupedSurveis as $antrianId => $surveis) {
            $totalScore = 0;
            foreach ($surveis as $survei) {
                // Assuming 'skor' is the attribute containing the score for each question
                $totalScore += $survei->skor;
            }
            // Calculate average score per survey, then multiply by 25
            $averageScore = ($totalScore / 9) * 25;
            $uniqueAverageScores[$antrianId] = $averageScore;
        }

        // Calculate total of unique average scores
        $totalUniqueAverageScore = array_sum($uniqueAverageScores);

        // Calculate overall average score per unique survey ID
        $overallAverageScore = $totalUniqueAverageScore / count($uniqueAverageScores);
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
        foreach ($groupedSurveis as $antrianId => $surveiGroup) {
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
        }

        // Format data pendidikan sesuai keinginan
        $formattedEducation = [
            'SD' => $totalEducation['SD'],
            'SMP' => $totalEducation['SMP'],
            'SMA' => $totalEducation['SMA'],
            'DIII' => $totalEducation['DIII'],
            'S1' => $totalEducation['S1'],
            'S2' => $totalEducation['S2'],
            'S3' => $totalEducation['S3'],
        ];
        $earliestSurvey = $surveis->sortBy('created_at')->first();
        $latestSurvey = $surveis->sortByDesc('created_at')->first();

        $earliestTime = $earliestSurvey->created_at->format('d-m-Y');
        $latestTime = $latestSurvey->created_at->format('d-m-Y');
        $instansi_id = $request->input('instansi');
        $nama_instansi = Instansi::findOrFail($instansi_id)->name;
        $nama_outlet = Outlet::findOrFail($outlet_id)->nama_layanan;
        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Buat HTML untuk konten yang akan dicetak (contoh saja)
        $html = view('dashboard.survei.show', [
            'title' => 'Detail Survei',
            'surveis' => $surveis,
            'instansi' => $nama_instansi,
            'outlet_id' => $outlet_id,
            'nama_layanan' => $nama_outlet,
            'average_score' => $overallAverageScore, // Menggunakan skor rata-rata keseluruhan
            'final_score' => round($overallAverageScore, 1), // Jika final score sama dengan skor rata-rata
            'total_visitors' => $totalVisitors,
            'total_education' => $formattedEducation,
            'total_male' => $totalMale,
            'total_female' => $totalFemale,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'year' => date('Y'),
            'lama' => $earliestTime,
            'baru' => $latestTime
        ])->render();

        // Tambahkan konten ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Keluarkan PDF ke browser
        $dompdf->stream('nama_file.pdf');
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

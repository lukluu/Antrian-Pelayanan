<?php

namespace App\Http\Controllers;

use App\Models\Skor;
use App\Models\Survei;
use App\Models\Antrian;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class SurveiController extends Controller
{
    public function index()
    {
        return view('survei', [
            "title" => "Survei | Isi-Survei",
        ]);
    }

    public function survei()
    {
        $antrian = Antrian::with('outlet')->where('status', 1)->where('survei', 0)->get();
        return view('isi-survei', [
            "title" => "Survei | Isi Survei",
            'antrians' => $antrian,
        ]);
    }



    public function show($id)
    {
        $antrian = Antrian::findOrFail($id);
        $survei = Pertanyaan::all(); // Mengambil semua pertanyaan dari tabel pertanyaans
        return view('isi-survei-mulai', [
            "title" => "Survei | Isi Survei Mulai",
            'antrian_id' => $antrian->id,
            'survei_status' => $antrian->survei,
            'question' => $survei, // Mengubah variable 'question' menjadi 'questions'
        ]);
    }


    public function update(Request $request, $antrian_id)
    {
        // Validasi request
        $validatedData = $request->validate([
            'antrian_id' => 'required|integer',
            'survei_status' => 'required|integer',
            'skor' => 'required|array',
            'skor.*' => 'required|integer|min:1|max:5',
            'survei_id' => 'required|array',
            'survei_id.*' => 'required|integer', // Validasi untuk setiap survei_id
        ]);

        if (!empty($validatedData['skor'])) {
            foreach ($validatedData['skor'] as $index => $skor) {
                Survei::updateOrCreate(
                    ['antrian_id' => $validatedData['antrian_id'], 'pertanyaan_id' => $validatedData['survei_id'][$index]], // Menggunakan pertanyaan_id sebagai kunci
                    ['skor' => $skor]
                );
            }
        }

        // Mengupdate status survei pada tabel antrian
        $antrian = Antrian::findOrFail($antrian_id);
        $antrian->update(['survei' => $validatedData['survei_status']]);

        // Redirect atau response sesuai kebutuhan
        return redirect('survei/isi-survei')->with('success', 'Survei berhasil disimpan!');
    }
}

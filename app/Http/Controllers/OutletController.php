<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Antrian;
use App\Models\Instansi;

use Illuminate\Http\Request;
use Psy\Exception\Exception;
use function Laravel\Prompts\outro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class OutletController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // $outlet = $user->outlet->get();
        // $outlet = Outlet::with('user')->get();
        $instansi = Instansi::with(['user', 'outlet'])->get();


        // dd($instansi);
        return view('dashboard.outlet.index', [
            'title' => 'Dashboard | Daftar Layanan',
            'active' => 'layanan',
            'outlets' => $instansi,
        ]);
    }
    public function tambah()
    {
        $stafs = User::whereNotIn('id', Instansi::pluck('user_id')->all())->get();
        $outlets = Instansi::select('kode')->distinct()->get();
        $kodes = [];
        foreach ($outlets as $outlet) {
            $kodes[] = $outlet->kode;
        }


        return view('dashboard.outlet.create', [
            'title' => 'Tambah Outlet',
            'stafs' => $stafs,
            'kodes' => $kodes,
        ]);
    }

    public function detail(Request $request, $id)
    {
        $instansi = Instansi::with('outlet')->findOrFail($id);
        $layanan = [];
        foreach ($instansi->outlet as $outlet) {
            $layanan[] = [
                'id' => $outlet->id,
                'name' => $outlet->nama_layanan,
                'syarat1' => $outlet->syarat1,
                'syarat2' => $outlet->syarat2,
                'syarat3' => $outlet->syarat3,
                'syarat4' => $outlet->syarat4,
                'syarat5' => $outlet->syarat5,
                'status' => $outlet->status,
            ];
        }
        return view('dashboard.outlet.detail', [
            'title' => 'Data Instansi | Detail Layanan Instansi',
            'layanans' => $layanan,
            'nama_instansi' => $instansi->name,
            'instansi_id' => $instansi->id,
            'nama_panjang' => $instansi->nama_kepanjangan,

        ]);
    }

    public function editInstansi($id)
    {
        $instansi = Instansi::findOrFail($id);
        $currentStafId = $instansi->user_id;
        $assignedStaf = User::where('id', $currentStafId)->get();
        $kodes = $instansi->kode;
        $availableStaf = User::where('role', '!=', 'admin')->whereDoesntHave('instansi')->get();
        $stafs = $assignedStaf->merge($availableStaf)->unique('id');


        return view('dashboard.outlet.edit', [
            'title' => 'Data Instansi | Edit Instansi',
            'instansi' => $instansi,
            'kodes' => $kodes,
            'stafs' => $stafs,
            'currentStafId' => $currentStafId
        ]);
    }

    public function update(Request $request, $id)
    {
        $instansi = Instansi::findOrFail($id);

        // Validasi input termasuk gambar
        $request->validate([
            'sektor' => 'max:1',
            'kode' => 'unique:instansis,kode,' . $id,
            'name' => 'unique:instansis,name,' . $id,
            'nama_kepanjangan' => 'unique:instansis,nama_kepanjangan,' . $id,
            'user_id' => 'exists:users,id',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Misalnya, batasan ukuran 2MB untuk gambar
        ]);
        // Inisialisasi variabel untuk menyimpan nama file gambar baru
        $newFileName = null;

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('logo')) {
            // Hapus gambar lama jika ada
            if ($instansi->logo) {
                // Dapatkan path lengkap ke gambar lama di dalam folder public
                $oldImagePath = public_path('img/logo-instansi/' . $instansi->logo);

                // Hapus gambar lama jika file ada
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Simpan gambar baru
            $file = $request->file('logo');
            $newFileName = time() . '_' . $file->getClientOriginalName(); // Generate nama file baru
            $file->move(public_path('img/logo-instansi'), $newFileName); // Simpan file ke folder public/img/logo-instansi
        }

        // Update data instansi dengan nama file gambar baru (jika ada)
        $instansi->update([
            'logo' => $newFileName, // Simpan nama file baru dalam kolom logo
            'kode' => $request->kode,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'nama_kepanjangan' => $request->nama_kepanjangan,
            'sektor' => $request->sektor,
        ]);

        return back()->with('success', 'Instansi updated successfully.');
    }



    public function createLayanan(Request $request)
    {

        try {
            // Validasi data request
            $validatedData = $request->validate([
                'nama_layanan' => 'required|max:255|unique:outlets',
                'syarat1' => 'required|max:15',
                'instansi_id'  => 'required|exists:instansis,id',
            ], [
                'nama_layanan.unique' => 'Nama Layanan sudah terdaftar. Silahkan gunakan nama lain.',
                'instansi_id.exists' => 'Instansi tidak ditemukan. Pilih instansi yang valid.',
            ]);

            // Simpan data ke database
            Outlet::create($validatedData);

            return back()->with('success', 'Layanan Berhasil Ditambahkan!');
        } catch (ValidationException $e) {
            // Kembalikan ke halaman sebelumnya dengan pesan error
            return back()->withErrors($e->validator->errors());
        }



        // Outlet::create($validatedData);
        // return back()->with('success', 'Berhasil Ditambahkan!');
    }
    public function create(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'nama_kepanjangan' => 'max:255',
            'kode' => 'required', //harus beda
            'user_id' => 'required',
            'sektor' => 'required',
        ]);
        Instansi::create($validatedData);
        return redirect('dashboard/data-instansi')->with('success', 'Berhasil Ditambahkan!');
    }

    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();
        return back()->with('success', 'Instansi deleted successfully.');
    }
    public function destroyLayanan($id)
    {
        $layanan = Outlet::findOrFail($id);
        $layanan->delete();

        return back()->with('success', 'Layanan Dihapus.');
    }
    public function editLayanan(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|max:255',
        ]);
        $layanan = Outlet::findOrFail($id);
        $dataToUpdate = [];
        // Periksa apakah input 'name' diubah dan tambahkan ke array jika iya
        if ($request->has('nama_layanan')) {
            $dataToUpdate['nama_layanan'] = $request->nama_layanan;
        }
        if ($request->has('syarat1')) {
            $dataToUpdate['syarat1'] = $request->syarat1;
        }
        if ($request->has('syarat2')) {
            $dataToUpdate['syarat2'] = $request->syarat2;
        }
        if ($request->has('syarat3')) {
            $dataToUpdate['syarat3'] = $request->syarat3;
        }
        if ($request->has('syarat4')) {
            $dataToUpdate['syarat4'] = $request->syarat4;
        }
        if ($request->has('syarat5')) {
            $dataToUpdate['syarat5'] = $request->syarat5;
        }
        $layanan->update($dataToUpdate);
        return back()->with('success', 'Layanan berhasil diperbarui.');
    }


    public function updateAktif(Request $request, $id)
    {
        $instansi = Instansi::findOrFail($id);
        $aktif = $request->aktif; // Ambil nilai aktif dari request

        $instansi->update(['aktif' => $aktif]); // Update status aktif instansi

        return response()->json(['message' => 'Status aktif instansi berhasil diperbarui']);
    }
    public function updateAktifOutlet(Request $request, $id)
    {
        $layanan = Outlet::findOrFail($id);
        $aktif = $request->status; // Ambil nilai aktif dari request

        $layanan->update(['status' => $aktif]); // Update status aktif instansi

        return response()->json(['message' => 'Status aktif instansi berhasil diperbarui']);
    }
}

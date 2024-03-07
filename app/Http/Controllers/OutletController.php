<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Antrian;
use App\Models\Instansi;

use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use function Laravel\Prompts\outro;
use Illuminate\Support\Facades\Auth;

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
                'name' => $outlet->nama_layanan
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
        $validatedData = $request->validate([
            'nama_kepanjangan' => 'required|max:255',
            'name' => 'required|max:255',
            'kode' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);
        $instansi = Instansi::findOrFail($id);
        $instansi->nama_kepanjangan = $validatedData['nama_kepanjangan'];
        $instansi->name = $validatedData['name'];
        $instansi->kode = $validatedData['kode'];
        $instansi->user_id = $validatedData['user_id'];
        $instansi->save();

        return redirect('/dashboard/data-instansi/')->with('success', 'Instansi updated successfully.');
    }


    public function createLayanan(Request $request)
    {

        try {
            // Validasi data request
            $validatedData = $request->validate([
                'nama_layanan' => 'required|max:255|unique:outlets',
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
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->save();
        return back()->with('success', 'Layanan berhasil diperbarui.');
    }
}

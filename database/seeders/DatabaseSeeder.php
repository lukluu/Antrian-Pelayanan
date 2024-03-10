<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use \App\Models\Post;
use \App\Models\User;
use App\Models\Outlet;
use App\Models\People;
use App\Models\Survei;
use App\Models\Syarat;
use App\Models\Antrian;
use App\Models\Instansi;
use \App\Models\Category;
use App\Models\Pertanyaan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'oiss',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' => 'admin', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Amel',
            'username' => 'gerai-1',
            'email' => 'gera1@gmail.com',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Putra',
            'username' => 'gerai-2',
            'email' => 'gera2@gmail.com',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Lukman',
            'username' => 'lukman',
            'email' => 'gera3@gmail.com',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        Instansi::create([
            'name' => 'SAMSAT',
            'nama_kepanjangan' => 'Sistem Administrasi Menunggal Satu Atap',
            'kode' => 'A',
            'sektor' => '1',
            'user_id' => 2
        ]);
        Instansi::create([
            'name' => 'PTSP',
            'nama_kepanjangan' => 'Pelayanan Terpadu Satu Pintu',
            'kode' => 'B',
            'sektor' => '2',
            'user_id' => 3
        ]);

        Outlet::create([
            'nama_layanan' => "Bayar Bajak",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
            'syarat2' => 'Surat Pengantar'
        ]);
        Outlet::create([
            'nama_layanan' => "Permohonan Kerja",
            'instansi_id' => 2,
            'syarat1' => 'KTP',
            'syarat2' => 'Surat Pengantar'

        ]);
        Outlet::create([
            'nama_layanan' => "Registrasi Kendaraan",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
            'syarat2' => 'Surat Pengantar'
        ]);
        Antrian::create([
            'outlet_id' => 1,
            'no_antri' => 'A-1',
            'status' => 0,
            'survei' => 0,
        ]);

        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 1',
            'unsur' => 'Kesesuaian Pelayanan'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 2',
            'unsur' => 'Kemudahan Pelayanan'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 3',
            'unsur' => 'Kecepatan Pelayanan'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 4',
            'unsur' => 'Kewajaran Biaya'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 5',
            'unsur' => 'Kesesuaian Produk'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 6',
            'unsur' => 'Kemampuan Petugas'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 7',
            'unsur' => 'Perilaku Petugas'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 8',
            'unsur' => 'Kualitas Sarana dan Prasarana'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'pertanyaan 9',
            'unsur' => 'Penanganan Pengaduan'
        ]);
    }
}

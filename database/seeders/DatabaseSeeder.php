<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use \App\Models\Post;
use \App\Models\User;
use App\Models\Outlet;
use App\Models\People;
use App\Models\Antrian;
use App\Models\Instansi;
use \App\Models\Category;
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
            'user_id' => 2
        ]);
        Instansi::create([
            'name' => 'PTSP',
            'nama_kepanjangan' => 'Pelayanan Terpadu Satu Pintu',
            'kode' => 'B',
            'user_id' => 3
        ]);

        Outlet::create([
            'nama_layanan' => "Bayar Bajak",
            'instansi_id' => 1
        ]);
        Outlet::create([
            'nama_layanan' => "Permohonan Kerja",
            'instansi_id' => 2,

        ]);
        Outlet::create([
            'nama_layanan' => "Registrasi Kendaraan",
            'instansi_id' => 1,
        ]);
        Antrian::create([
            'outlet_id' => 1,
            'no_antri' => 'A-1',
            'nama' => "Lukmana",
            'nik' => 123,
            'no_hp' => 12345,
            'ttl' => '12/12/2002',
            'gender' => "Pria",
            'alamat' => "Kambu",
            'kelurahan' => 'Jl.Tekukur',
            'Kecamatan' => 'Kambu',
            'pekerjaan' => "Mahasiswa",
            'status' => 0,
        ]);
    }
}

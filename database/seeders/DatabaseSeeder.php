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
            'name' => 'ADMIN',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' => 'admin', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'PTSP',
            'username' => 'ptsp',
            'email' => 'gera1@gmail.com',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BNN',
            'username' => 'bnn',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'PBG',
            'username' => 'pbg',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'SPR',
            'username' => 'spr',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'KPP',
            'username' => 'kpp',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BAPENDA',
            'username' => 'bapenda',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Imigrasi',
            'username' => 'imgirasi',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BPOM',
            'username' => 'bpom',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BPN',
            'username' => 'bpn',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'DISDUKCAPIL',
            'username' => 'capil',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Bank Sultra',
            'username' => 'banksultra',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Bank BRI',
            'username' => 'bankbri',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'SAMSAT',
            'username' => 'samsat',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'DISNAKERTRANS',
            'username' => 'disnakertans',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'DINKES',
            'username' => 'dinkes',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'DEKRANAS',
            'username' => 'dekranas',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Pegadaian',
            'username' => 'pegadaian',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'POS',
            'username' => 'pos',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BPJS Ketenagakerjaan',
            'username' => 'bpjskerja',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BPS',
            'username' => 'bps',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'KEMENAG',
            'username' => 'kemenag',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BEA CUKAI',
            'username' => 'beacukai',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'PDAM',
            'username' => 'pdam',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'UKPBJ',
            'username' => 'ukpbj',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Pangan',
            'username' => 'pangan',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'KEJATI',
            'username' => 'kejati',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Kejaksaan Negeri Kendari',
            'username' => 'jaksakendari',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Pengadilan',
            'username' => 'pengadilan',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BPJH',
            'username' => 'bpjh',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'BPJS Kesehatan',
            'username' => 'bpjskesehatan',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Ombudsman',
            'username' => 'ombudsman',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'AMDAL',
            'username' => 'amdal',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'POLRES',
            'username' => 'polres',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'DINSOS',
            'username' => 'dinsos',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);
        User::create([
            'name' => 'Perpustakaan',
            'username' => 'perpustakaan',
            'password' => 'password',
            'role' => 'user', // Assign the randomly selected role
        ]);

        // DPMPTSP KOTA KENDARI
        Instansi::create([
            'name' => 'DPMPTSP Kota Kendari',
            'nama_kepanjangan' => 'Pelayanan Terpadu Satu Pintu',
            'kode' => 'A',
            'sektor' => '1',
            'user_id' => 2
        ]);
        Outlet::create([
            'nama_layanan' => "Berbantuan Pendaftaran Sicantik",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Berbantuan SIMBG",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Berbantuan OSS",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Berbantuan LKPM",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Berbantuan Pengambilan",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "KonsultasiD DPMPTSP",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengaduan / WBS",
            'instansi_id' => 1,
            'syarat1' => 'KTP',
        ]);
        // AKHIR DPMPTSP
        // LAYANAN BNN
        Instansi::create([
            'name' => 'BNN Kota Kendari',
            'nama_kepanjangan' => 'Badan Narkotika Nasional',
            'kode' => 'B',
            'sektor' => '2',
            'user_id' => 3,
            'logo' => 'bnn.png'
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Hasil Pemeriksaan Narkotika",
            'instansi_id' => 2,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi BNN",
            'instansi_id' => 2,
            'syarat1' => 'KTP',
        ]);
        // BNN AHIR
        // SEKRETARIAT PBG
        Instansi::create([
            'name' => 'Sekretariat PBG',
            'nama_kepanjangan' => '',
            'kode' => 'C',
            'sektor' => '2',
            'user_id' => 4,
            'logo' => 'pbg.png'
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Perbantuan PBG",
            'instansi_id' => 3,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi PBG",
            'instansi_id' => 3,
            'syarat1' => 'KTP',
        ]);
        // SEKRETARIAT PBG AKHIR
        // SEKRETARIAT Penataan Ruang
        Instansi::create([
            'name' => 'Sekretariat Penataan Ruang',
            'nama_kepanjangan' => '',
            'kode' => 'D',
            'sektor' => '2',
            'user_id' => 5,
            'logo' => 'tata-ruang.png'
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Perbantuan Tata Ruang",
            'instansi_id' => 4,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi Tata Ruang",
            'instansi_id' => 4,
            'syarat1' => 'KTP',
        ]);
        // SEKRETARIAT Penataan Ruang AKHIR
        // KPP
        Instansi::create([
            'name' => 'KPP Pratama Kendari',
            'nama_kepanjangan' => 'Kantor Pelayana Pajak',
            'kode' => 'E',
            'sektor' => '2',
            'user_id' => 6,
            'logo' => 'kpp.png'
        ]);
        Outlet::create([
            'nama_layanan' => "Cetak Ulang Kartu NPWP",
            'instansi_id' => 5,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Aktivasi E-FIN",
            'instansi_id' => 5,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Asistensi Layanan Mandiri",
            'instansi_id' => 5,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi KPP",
            'instansi_id' => 5,
            'syarat1' => 'KTP',
        ]);
        // KPP AKHIR
        // BAPENDA
        Instansi::create([
            'name' => 'BAPENDA Kota Kendari',
            'nama_kepanjangan' => 'Badan Pendapatan Daerah',
            'kode' => 'F',
            'sektor' => '3',
            'user_id' => 7
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran BPHTB (Hak Baru , Hak Waris)",
            'instansi_id' => 6,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran PBB",
            'instansi_id' => 6,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pelayanan Pajak Wilayah I (Hiburan, Air Bawah Tanah, Restoran/RM, PPJ)",
            'instansi_id' => 6,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pelayanan Pajak Wilayah II (Hotel, Parkir, Sarang Walet, Mineral non Logam dan Batuan, Reklame)",
            'instansi_id' => 6,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Help Desk",
            'instansi_id' => 6,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengambilan Dokumen (PBB, PBHTB)",
            'instansi_id' => 6,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengaduan",
            'instansi_id' => 6,
            'syarat1' => 'KTP',
        ]);
        // BAPENDA AKHIR
        // KANTOR MIGRASI KELAS I TPI KENDARI
        Instansi::create([
            'name' => 'Kantor Imigrasi Kelas I TPI Kendari',
            'nama_kepanjangan' => 'Kantor Migrasi',
            'kode' => 'G',
            'sektor' => '4',
            'user_id' => 8,
            'logo' => 'imigrasi.svg'
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Informasi",
            'instansi_id' => 7,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pembuatan Dokumen Perjalanan Republik Indonesia (DPRI) Baru",
            'instansi_id' => 7,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pergantian Dokumen Perjalanan Republik Indonesia (DPRI)",
            'instansi_id' => 7,
            'syarat1' => 'KTP',
        ]);
        // KANTOR MIGRASI KELAS I TPI KENDARI AKHIR
        // BPOM KOTA KENDARI
        Instansi::create([
            'name' => 'BPOM Kota Kendari',
            'nama_kepanjangan' => 'Badan Pengawas Obat dan Makanan',
            'kode' => 'H',
            'sektor' => '3',
            'user_id' => 9,
            'logo' => 'bpom.png'
        ]);
        Outlet::create([
            'nama_layanan' => "Uji Sampel Pihak Ketiga Obat dan Makanan",
            'instansi_id' => 8,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pendampingan dan Audit Sarana Dalam Rangka Sertifikasi e-Reg",
            'instansi_id' => 8,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Informasi dan Pengaduan",
            'instansi_id' => 8,
            'syarat1' => 'KTP',
        ]);
        // BPOM KOTA KENDARI AKHIR
        // PERTANAHAN
        Instansi::create([
            'name' => 'BPN Kota Kendari',
            'nama_kepanjangan' => 'Badan Pertanahan National Kota Kendari',
            'kode' => 'I',
            'sektor' => '4',
            'user_id' => 10,
        ]);
        Outlet::create([
            'nama_layanan' => "Peralihan Hak",
            'instansi_id' => 9,
            'syarat1' => 'KTP',

        ]);
        Outlet::create([
            'nama_layanan' => "Penghapusan Hak Tanggungan",
            'instansi_id' => 9,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengecekan Plot / Pengecekan Bidang Tanah",
            'instansi_id' => 9,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Informasi Kesesuaian Tata Ruang",
            'instansi_id' => 9,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Informasi dan Pengaduan Pertanahan",
            'instansi_id' => 9,
            'syarat1' => 'KTP',
        ]);
        // Pertanahan AKHIR
        // DISDUKCAPIL
        Instansi::create([
            'name' => 'DISDUKCAPIL KOTA KENDARI',
            'nama_kepanjangan' => 'Dinas Kependudukan dan Pencatatan Sipil',
            'kode' => 'J',
            'sektor' => '1',
            'user_id' => 11

        ]);
        Outlet::create([
            'nama_layanan' => "Biodata Penduduk",
            'instansi_id' => 10,
            'syarat1' => '',
        ]);
        Outlet::create([
            'nama_layanan' => "Kartu Keluarga",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "KTP-EL",
            'instansi_id' => 10,
            'syarat1' => '',
        ]);
        Outlet::create([
            'nama_layanan' => "Kartu Identitas Anak",
            'instansi_id' => 10,
            'syarat1' => 'Kartu Keluarga',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pindah Keluar",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pindah Datang",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pindah Luar Negeri",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pindah Datang Negeri",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Tempat Tinggal",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Lahir Mati",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Akta Kelahiran",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Akta Kematian",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Akta Perkawinan",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Akta Perceraian",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Akta Pengakuan Anak",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Akta Pengesahan Anak",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Catatan Pinggir Pengangkatan Anak",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Catatan Pinggir Perubahan Anak",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pembatalan Perkawinan",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pembatalan Perceraian",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pelepasan Kewarganegaraan",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pengganti Tanda Penduduk",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Pencatatan Sipil",
            'instansi_id' => 10,
            'syarat1' => 'KTP',
        ]);
        Antrian::create([
            'outlet_id' => 1,
            'no_antri' => 'A-1',
            'status' => 0,
        ]);
        // DISDUKCAPIL AKHIR
        // BANSULTRA
        Instansi::create([
            'name' => 'BANK SULTRA',
            'nama_kepanjangan' => 'Bank Sulawesi Tenggara',
            'kode' => 'K',
            'sektor' => '2',
            'user_id' => 12,
            'logo' => 'bank-sultra.png'
        ]);
        Outlet::create([
            'nama_layanan' => "Pembukaan Rekening Tabungan, Giro dan Deposito",
            'instansi_id' => 11,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pembukaan ATM dan Pengaktifan SMS-Banking",
            'instansi_id' => 11,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Kliring dan RTGS",
            'instansi_id' => 11,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pembayaran Pajak",
            'instansi_id' => 11,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Penarikan dan Setoran",
            'instansi_id' => 11,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengaduan Nasabah Bank Sultra",
            'instansi_id' => 11,
            'syarat1' => 'KTP',
        ]);
        // Bank Sultra Akhir
        // Bank BRI Awal
        Instansi::create([
            'name' => 'BANK BRI Cabang Kendari',
            'nama_kepanjangan' => '',
            'kode' => 'L',
            'sektor' => '2',
            'user_id' => 13,
            'logo' => 'bank-bri.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Pembukan Rekening Tabungan",
            'instansi_id' => 12,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Penerbitan Kartu ATM",
            'instansi_id' => 12,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pergantian Kartu yang rusa/hilangs",
            'instansi_id' => 12,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Registrasi BRIMO,SMS Banking, SMS Notifiasi, Internet Baning Bisnis BRI (IBBIZ), dan Cash Manajement System BRI",
            'instansi_id' => 12,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pelayanan Setor, Tari, kliring, dan RTGS",
            'instansi_id' => 12,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pelayanan Aduan/komplain Nasabah",
            'instansi_id' => 12,
            'syarat1' => 'KTP',
        ]);
        // Bank BRI Akhir
        //awal SAMSAT
        Instansi::create([
            'name' => 'SAMSAT Kota Kendari',
            'nama_kepanjangan' => '',
            'kode' => 'M',
            'sektor' => '1',
            'user_id' => 14,
            'logo' => 'samsat.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengesahan STNK",
            'instansi_id' => 13,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi Samsat",
            'instansi_id' => 13,
            'syarat1' => 'KTP',
        ]);
        //samsat akhir
        //Disnaertrans awal
        Instansi::create([
            'name' => 'DISNAKERTRANS Kota Kendari',
            'nama_kepanjangan' => '',
            'kode' => 'N',
            'sektor' => '2',
            'user_id' => 15,
        ]);
        Outlet::create([
            'nama_layanan' => "Kartu Pencari Kerja (K1)",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Calon Pekerja Migran Indonesia",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Lembaga Pelatihan Kerja Swasta",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Balai Latihan Kerja Komunitas",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Bursa Kerja Khusus",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Izin Penyelenggaraan Job Fair",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Informasi Pemagangan dalam dan luar negri",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Info Lowongan Kerja dan Pelatihan",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Penyelesaian Penyelisihan Hubungan Industrial",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pengesahan Peraturan Perusahaan",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pengesahan LKS Bipartid",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pencatatan Seriat Pekerja (SP)/Seriat Buruh",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pendaftaran Perjanjian Kerjasama",
            'instansi_id' => 14,
            'syarat1' => 'KTP',
        ]);
        //akhir DISNAERTRANS
        //awal Dinkes
        Instansi::create([
            'name' => 'DINKES Kota Kendari',
            'nama_kepanjangan' => 'Dinas Kesehatan Kota Kendari',
            'kode' => 'O',
            'sektor' => '2',
            'user_id' => 16,
        ]);
        Outlet::create([
            'nama_layanan' => "Counter Labkesda",
            'instansi_id' => 15,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Poliklinik",
            'instansi_id' => 15,
            'syarat1' => 'KTP',
        ]);
        //akhir Dinkes
        //awal Dekranas
        Instansi::create([
            'name' => 'Dekranas Kota Kendari',
            'nama_kepanjangan' => 'Dewan Kerajinan Nasional',
            'kode' => 'P',
            'sektor' => '2',
            'user_id' => 17,
        ]);
        Outlet::create([
            'nama_layanan' => "Media Promosi Dekranas",
            'instansi_id' => 16,
            'syarat1' => 'KTP',
        ]);
        //akhir Dekranas
        //awal pegadaian
        Instansi::create([
            'name' => 'PT. Pegadaian',
            'nama_kepanjangan' => 'Pegadaian Kantor Area Kendari',
            'kode' => 'Q',
            'sektor' => '2',
            'user_id' => 18,
            'logo' => 'pegadaian.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Media Promosi PT.Pegadaian",
            'instansi_id' => 17,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Transaksi Produk Gadai",
            'instansi_id' => 17,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Transaksi Infestasi Logam Mulia",
            'instansi_id' => 17,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Transaksi Infestasi Tabungan Emas",
            'instansi_id' => 17,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Transaksi Ibadah Haji",
            'instansi_id' => 17,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Transaksi Pemayaran Kendaraan",
            'instansi_id' => 17,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Transaksi Kredit Usaha/Pegawai/Profesional",
            'instansi_id' => 17,
            'syarat1' => 'KTP',
        ]);
        //ahir pegadaian
        // Awal Pt.POS
        Instansi::create([
            'name' => 'Kantor POS Cabang Kendari',
            'nama_kepanjangan' => 'PT.POS Indonesia',
            'kode' => 'R',
            'sektor' => '2',
            'user_id' => 19,
            'logo' => 'pos.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Pelayanan Pembayaran",
            'instansi_id' => 18,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengiriman Surat Dan Paket",
            'instansi_id' => 18,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengiriman Uang",
            'instansi_id' => 18,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Asuransi",
            'instansi_id' => 18,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Tabungan",
            'instansi_id' => 18,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pensiun",
            'instansi_id' => 18,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Kredit Pensiun",
            'instansi_id' => 18,
            'syarat1' => 'KTP',
        ]);
        // Akhir Pt.POS
        // Awal BPJS
        Instansi::create([
            'name' => 'BPJS Ketenegakerjaan Cabang Kendari',
            'nama_kepanjangan' => 'BPJS Ketenagakerjaan',
            'kode' => 'S',
            'sektor' => '2',
            'user_id' => 20,
            'logo' => 'bpjs-ketenagakerjaan.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran Peserta Penerima Upah (PU) Bagi Badan Usaha Yang Bersifat Wajib",
            'instansi_id' => 19,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran Peserta Bukan Penerima Ubah (BPU) Bagi Tenaga Kerja Mandiri",
            'instansi_id' => 19,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran Peserta Jasa Konstruksi",
            'instansi_id' => 19,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Informasi Manfaat Program dan Layanan BPJS Ketenagakerjaan",
            'instansi_id' => 19,
            'syarat1' => 'KTP',
        ]);
        // Akhir BPJS
        // Awal BPS
        Instansi::create([
            'name' => 'BPS Kota Kendari',
            'nama_kepanjangan' => 'Badan Pusat Statistik Kota Kendari',
            'kode' => 'T',
            'sektor' => '2',
            'user_id' => 21,
            'logo' => 'bps.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Statistik Terpadu",
            'instansi_id' => 20,
            'syarat1' => 'KTP',
        ]);
        // ahir BPS
        // Awal Kemenag
        Instansi::create([
            'name' => 'KEMENAG KOTA KENDARI',
            'nama_kepanjangan' => 'Kementerian Agama Kota Kendari',
            'kode' => 'U',
            'sektor' => '3',
            'user_id' => 22,
            'logo' => 'kemenag.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran Tanah Wakaf",
            'instansi_id' => 21,
            'syarat1' => 'KTP',
        ]);
        // Akhir Kemenag
        // Bea Cukai
        Instansi::create([
            'name' => 'KANWIL DIRJEN BEA CUKAI',
            'nama_kepanjangan' => 'Kantor Wilayah Direktur Jenderal Bea Cukai Sulawesi Bagian Selatan',
            'kode' => 'V',
            'sektor' => '4',
            'user_id' => 23,
            'logo' => 'beacukai.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Registrasi IMEI",
            'instansi_id' => 22,
            'syarat1' => 'KTP',
        ]);
        // Akhir Bea Cukai
        // PDAM
        Instansi::create([
            'name' => 'PDAM Tirta Anoa',
            'nama_kepanjangan' => '',
            'kode' => 'W',
            'sektor' => '4',
            'user_id' => 24,
            'logo' => 'tirta-anoa.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Sambungan Baru ",
            'instansi_id' => 23,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pembayaran Rekening Air",
            'instansi_id' => 23,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Penyambungan Kembali",
            'instansi_id' => 23,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Informasi dan Pengaduan PDAM",
            'instansi_id' => 23,
            'syarat1' => 'KTP',
        ]);
        // Akhir PDAM
        // UKPBJ
        Instansi::create([
            'name' => 'UKPBJ',
            'nama_kepanjangan' => '',
            'kode' => 'X',
            'sektor' => '4',
            'user_id' => 25,
            'logo' => 'ukpbj.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Konsultasi",
            'instansi_id' => 24,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengaduan UKPBJ",
            'instansi_id' => 24,
            'syarat1' => 'KTP',
        ]);
        // Akhir UKPBJ
        // Badan Ketahanan PAngan
        Instansi::create([
            'name' => 'Badan Ketahanan Pangan',
            'nama_kepanjangan' => '',
            'kode' => 'Y',
            'sektor' => '3',
            'user_id' => 26,
        ]);
        Outlet::create([
            'nama_layanan' => "Media Promosi Ketahanan Pangan",
            'instansi_id' => 25,
            'syarat1' => 'KTP',
        ]);
        // Akhir Badan Ketahanan Pangan
        // Kejaksaan Sultra
        Instansi::create([
            'name' => 'KEJATI SULTRA',
            'nama_kepanjangan' => 'Kejaksaan Tinggi Sulawesi Tenggara',
            'kode' => 'Z',
            'sektor' => '3',
            'user_id' => 27,
            'logo' => 'kejaksaan.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Konsultasi Hukum",
            'instansi_id' => 26,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Penyuluhan Hukum",
            'instansi_id' => 26,
            'syarat1' => 'KTP',
        ]);
        // Akhir Kejaksaan SUltra
        // Kejaksaan Kendari
        Instansi::create([
            'name' => 'Kejaksaan Negeri Kendari',
            'nama_kepanjangan' => '',
            'kode' => 'ZA',
            'sektor' => '3',
            'user_id' => 28,
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi Hukum ",
            'instansi_id' => 27,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Penyuluhan Hukum Kejaksaan Negeri Kendari ",
            'instansi_id' => 27,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Tilang",
            'instansi_id' => 27,
            'syarat1' => 'KTP',
        ]);
        // Akhir Kejaksaan Kendari
        // Pengadilan Kendari
        Instansi::create([
            'name' => 'PENGADILAN NEGERI KENDARI',
            'nama_kepanjangan' => '',
            'kode' => 'ZB',
            'sektor' => '3',
            'user_id' => 29,
            'logo' => 'pn-kendari.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pembuatan Surat Keterangan",
            'instansi_id' => 28,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran E-Court",
            'instansi_id' => 28,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Informasi Denda Pelanggaran Lalu Lintas",
            'instansi_id' => 28,
            'syarat1' => 'KTP',
        ]);
        // Akhir Pengadilan Kendari
        // BPJH
        Instansi::create([
            'name' => 'BPJH SULTRA',
            'nama_kepanjangan' => '',
            'kode' => 'ZC',
            'sektor' => '3',
            'user_id' => 30,
            'logo' => 'bpjh.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Pelayanan Pendampingan Pengajuan Sertifikasi Halal",
            'instansi_id' => 29,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi Penyelenggaran Produk Halal",
            'instansi_id' => 29,
            'syarat1' => 'KTP',
        ]);
        // Akhir BPJH
        // BPJS SEHAT
        Instansi::create([
            'name' => 'BPJS Kesehatan',
            'nama_kepanjangan' => '',
            'kode' => 'ZD',
            'sektor' => '2',
            'user_id' => 31,
            'logo' => 'bpjs-kesehatan.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Pendaftaran BPJS Kesehatan",
            'instansi_id' => 30,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Perubahan Data BPJS Kesehatan",
            'instansi_id' => 30,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Informasi dan Pengaduan BPJS Kesehatan",
            'instansi_id' => 30,
            'syarat1' => 'KTP',
        ]);

        // Akhir BPJS SEHAT
        // Ombudsman
        Instansi::create([
            'name' => 'Ombudsman Perwakilan Sultra',
            'nama_kepanjangan' => '',
            'kode' => 'ZE',
            'sektor' => '2',
            'user_id' => 32,
            'logo' => 'ombudsman.jpeg',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi Ombudsman",

            'instansi_id' => 31,
            'syarat1' => 'KTP',

        ]);
        Outlet::create([
            'nama_layanan' => "Pengaduan Masyarakat Ombudsman",
            'instansi_id' => 31,
            'syarat1' => 'KTP',
        ]);

        // aKHIR OMBUDSMAN
        // Sekretariat AMDAL
        Instansi::create([
            'name' => 'Sekretariat AMDAL',
            'nama_kepanjangan' => '',
            'kode' => 'ZF',
            'sektor' => '2',
            'user_id' => 33,
            'logo' => 'amdal.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Konsultasi Sekretariat AMDAL",

            'instansi_id' => 32,
            'syarat1' => 'KTP',

        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Perbantuan Sekretariat AMDAL",
            'instansi_id' => 32,
            'syarat1' => 'KTP',
        ]);
        // aKHIR Sekretariat AMDAL\
        // Polres
        Instansi::create([
            'name' => 'POLRES Kendari',
            'nama_kepanjangan' => 'Kepolisian Resor Kendari',
            'kode' => 'ZG',
            'sektor' => '2',
            'user_id' => 34,
            'logo' => 'polres.png',
        ]);
        Outlet::create([
            'nama_layanan' => "Perpanjangan Surat Izin Mengemudi (SIM A dan SIM C)",
            'instansi_id' => 33,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Catatan Kepolisian (SKCK)",
            'instansi_id' => 33,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Surat Keterangan Tanda Laporan Kehilangan",
            'instansi_id' => 33,
            'syarat1' => 'KTP',
        ]);
        // aKHIR Polres
        // dinas sosial
        Instansi::create([
            'name' => 'Dinas Sosial',
            'nama_kepanjangan' => '',
            'kode' => 'ZH',
            'sektor' => '2',
            'user_id' => 35,
        ]);
        Outlet::create([
            'nama_layanan' => "Keterangan Terdaftar DTKS",
            'instansi_id' => 34,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Rekomendasi untuk pengurusan Jamkesda/KIP/KIS",
            'instansi_id' => 34,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pemadanan Data Teknik DTKS",
            'instansi_id' => 34,
            'syarat1' => 'KTP',
        ]);
        Outlet::create([
            'nama_layanan' => "Pengaduan dan Konsultasi Dinas Sosial",
            'instansi_id' => 34,
            'syarat1' => 'KTP',
        ]);
        // aKHIR dinas sosial
        // Perpustakaan
        Instansi::create([
            'name' => 'Dinas Perpustakaan dan Kearsipan',
            'nama_kepanjangan' => '',
            'kode' => 'ZI',
            'sektor' => '1',
            'user_id' => 36,
        ]);
        Outlet::create([
            'nama_layanan' => "Layanan Pojok Baca Digital (POCADI)",
            'instansi_id' => 35,
            'syarat1' => 'KTP',
        ]);
        // aKHIR Perpustakaan


        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana Pendapat Anda tentang kesesuaian
            persyaratan pelayanan dengan jenis pelayanannya?',
            'unsur' => 'Kesesuaian Pelayanan'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana pemahaman Saudara tentang kemudahan
            prosedur pelayanan di unit ini?',
            'unsur' => 'Kemudahan Pelayanan'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kecepatan
            waktu dalam memberikan pelayanan?',
            'unsur' => 'Kecepatan Pelayanan'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kewajaran
            biaya/tarif dalam pelayanan?',
            'unsur' => 'Kewajaran Biaya'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kesesuaian
            produk pelayanan antara yang tercantum dalam
            standar pelayanan dengan hasil yang diberikan?',
            'unsur' => 'Kesesuaian Produk'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kompetensi/
            kemampuan petugas dalam pelayanan?',
            'unsur' => 'Kemampuan Petugas'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagamana pendapat saudara perilaku petugas dalam
            pelayanan terkait kesopanan dan keramahan?',
            'unsur' => 'Perilaku Petugas'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kualitas sarana
            dan prasarana?',
            'unsur' => 'Kualitas Sarana dan Prasarana'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang penanganan
            pengaduan pengguna layanan?',
            'unsur' => 'Penanganan Pengaduan'
        ]);
    }
}

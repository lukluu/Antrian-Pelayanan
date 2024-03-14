@include('layouts.head')
<style>
    .custom-margin {
        margin-top: 7em;
    }

    .custom-card {
        height: 300px;
        /* Atur tinggi card sesuai kebutuhan */
    }

    @media (max-width: 700px) {
        .custom-card {
            height: auto;
            /* Mengatur tinggi card menjadi otomatis */
        }
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        top: calc(100% + 5px);
        margin-top: 0;
        /* Sesuaikan jarak vertikal antara tombol profil dan dropdown */
        min-width: 150px;
        /* Sesuaikan lebar minimum dropdown */
    }

    .dropdown-menu.show {
        display: block;
    }

    .nav-link {
        cursor: pointer;
        /* Menjadikan pointer ketika dihover untuk menandakan klik */
    }

    .dropdown-toggle::after {
        display: none !important;
    }

    .profile-icon {
        display: inline-block;
        width: 32px;
        /* Sesuaikan ukuran ikon sesuai kebutuhan */
        height: 32px;
        /* Sesuaikan ukuran ikon sesuai kebutuhan */
        border-radius: 50%;
        /* Membuat ikon berbentuk lingkaran */
        background-color: #ccc;
        /* Warna latar belakang ikon */
        background-image: url('/assets2/assets/images/faces/1.jpg');
        /* URL gambar profil */
        background-size: cover;
        /* Mengisi area ikon tanpa merubah proporsi */
    }

    /* CSS */
    .row.mb-3 {
        display: flex;
        align-items: center;
    }

    .col-form-label.text-end {
        text-align: end;
        margin-right: 15px;
        /* Adjust the spacing between label and select */
    }
</style>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert2.min.js') }}"></script>

<body class="bg-gray-100">
    <div class="min-height-400 bg-primary opacity-10 position-absolute w-100"></div>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            @include('user.navbar.index')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <a href="/user/dashboard/terlayani" class="btn btn-danger btn-sm">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Keterangan</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $antrian->outlet->nama_layanan }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Nomor Antrian</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $antrian->no_antri }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Nama</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $antrian->nama }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">NIK</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $antrian->nik }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Jenis Kelamin</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $antrian->jkl }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Pendidikan Terakhir</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $antrian->pendidikan }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Tanggal Ambil Antrian</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $antrian->created_at }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Durasi Pelayanan</p>
                                <div class="col-sm-8">
                                    <small class="col-form-label text-center">: {{ $durasi }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-sm-4 col-form-label">Status Survei</p>
                                <div class="col-sm-8">
                                    @if( $antrian->survei == 1 )
                                    <small class="text-bolder text-success">: Sudah Mengisi</small>
                                    @else
                                    <small class="text-bolder text-danger">: Belum Mengisi</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('sweetalert::alert')
        @include('layouts.scripts')
</body>

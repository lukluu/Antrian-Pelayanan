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
                                    <a href="/user/dashboard/filter?layanan={{$layananId}}" class="btn btn-danger btn-sm">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <form action="/user/dashboard/data-melayani/{{$id}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Keterangan</p>
                                    <div class="col-sm-8">
                                        <small class="col-form-label text-center">: {{ $nama_layanan }}</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Nomor Antrian</p>
                                    <div class="col-sm-8">
                                        <small class="col-form-label text-center">: {{ $nomor_antrian }}</small>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-center">Isi Data Pengunjung</p>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Nama</p>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nama" value="{{$nama}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">NIK</p>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="nik" value="{{$nik}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Jenis Kelamin</p>
                                    <div class="col-sm-8 ms-auto">
                                        <select class="form-select" name="jkl" id="jkl">
                                            <option value="" {{ $jkl == "" ? "selected" : "" }}></option>
                                            <option value="Laki-Laki" {{ $jkl == "Laki-Laki" ? "selected" : "" }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ $jkl == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <p for="pendidikan" class="col-sm-3 col-form-label">Riwayat Pendidikan</p>
                                    <div class="col-sm-8 ms-auto">
                                        <select class="form-select" name="pendidikan" id="pendidikan">
                                            <option value="" {{ $pendidikan == "" ? "selected" : "" }}></option>
                                            <option value="SD" {{ $pendidikan == "SD" ? "selected" : "" }}>SD</option>
                                            <option value="SMP" {{ $pendidikan == "SMP" ? "selected" : "" }}>SMP</option>
                                            <option value="SMA" {{ $pendidikan == "SMA" ? "selected" : "" }}>SMA</option>
                                            <option value="DIII" {{ $pendidikan == "DIII" ? "selected" : "" }}>DIII</option>
                                            <option value="S1" {{ $pendidikan == "S1" ? "selected" : "" }}>S1</option>
                                            <option value="S2" {{ $pendidikan == "S2" ? "selected" : "" }}>S2</option>
                                            <option value="S3" {{ $pendidikan == "S3" ? "selected" : "" }}>S3</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @include('sweetalert::alert')
        @include('layouts.scripts')
</body>
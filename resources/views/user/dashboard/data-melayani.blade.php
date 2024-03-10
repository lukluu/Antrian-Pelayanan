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
</style>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert2.min.js') }}"></script>

<body class="bg-gray-100">
    <div class="min-height-400 bg-primary opacity-10 position-absolute w-100"></div>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <div class="navbar-brand font-weight-bolder text-black ms-lg-0 ms-3 ">
                            STAF {{ $instansi }}
                        </div>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="/user/dashboard">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="/user/dashboard/terlayani">
                                        Daftar Pengunjung Terlayani
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="/user/dashboard/survei-pengunjung">
                                        Survei Pengunjung
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-lg-block align-content-center">
                                <li class="nav-item dropdown">
                                    <div class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="profile-icon"></span>
                                    </div>

                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="/user/dashboard/setting">Settings</a></li>
                                        <li>
                                            <form action="/logout" method="post">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container  custom-margin">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">{{ strtoupper(auth()->user()->role) }}</a></li>
                            <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ strtoupper(auth()->user()->username) }}</li>
                        </ol>
                        <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
                    </nav>
                </div>
                <!-- End Navbar -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <a href="/user/dashboard" class="btn btn-danger btn-sm">Kembali</a>
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
                                        <input type="text" class="form-control" name="nik" value="{{$nik}}">
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
@include('layouts.head')
<style>
    .custom-margin {
        margin-top: 7em;
    }

    .custom-card {
        height: 300px;
        /* Atur tinggi card sesuai kebutuhan */
    }

    @media (max-width: 500px) {
        .custom-card {
            height: auto;
            /* Mengatur tinggi card menjadi otomatis */
        }
    }

    .page-link {
        color: black;
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
                        <a class="navbar-brand font-weight-bolder text-black ms-lg-0 ms-3 " href="../pages/dashboard.html">
                            STAF {{ strtoupper(auth()->user()->username) }}
                        </a>
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
                                    <a class="nav-link me-2" href="/user/dashboard/isi-survei">
                                        Survei Pengunjung
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-lg-block align-content-center">
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm w-100 mb-3">LogOut</button>
                                </form>
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
                                    <a href="/user/dashboard" class="btn btn-primary btn-sm">Kembali</a>
                                </div>
                                <div class="col-auto">
                                    <small class="badge bg-primary">{{ $nama_layanan }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Nama</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $nama }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">NIK</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $nik }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Taggal Lahir</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $tanggal_lahir }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Jenis Kelamin</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $gender }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Pekerjaan</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $pekerjaan }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Handphone</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $no_hp }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Alamat</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $alamat }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Keluahan</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $kelurahan }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p class="col-sm-4 col-form-label">Kecamatan</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ $kecamatan }}">
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

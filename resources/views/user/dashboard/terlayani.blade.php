<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">
</head>

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
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between">
                            <div class="col-6">
                                <h3>Data Terlayani</h3>
                            </div>
                            <div class="col-6 text-md-end">
                                <form action="/dashboard/terlayani/filter" method="GET" class="row g-3">
                                    <div class="col-auto">
                                        <input type="text" class="form-control datepicker " placeholder="Mulai" name="start_date" autocomplete="off">
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control datepicker" placeholder="Akhir" name="end_date" autocomplete="off">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary btn-sm">Filter Data</button>
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            Cetak <i class="bi bi-filetype-pdf"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <section class="section">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table1">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">No</th>
                                                    <th class="text-left">Antrian</th>
                                                    <th class="text-left">Durasi Melayani (menit)</th>
                                                    <th class="text-left">Nama</th>
                                                    <th class="text-left">NIK</th>
                                                    <th class="text-left">Survei</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($antrians as $antrian)
                                                <tr>
                                                    <td class="text-left">{{ $loop->iteration }}</td>
                                                    <td class="text-left">{{ $antrian['nomor_antrian'] }}</td>
                                                    <td class="text-left">{{ $antrian['durasi'] }}</td>
                                                    <td class="text-left">{{ $antrian['nama'] }}</td>
                                                    <td class="text-left">{{ $antrian['nik'] }}</td>
                                                    <td class="text-left">
                                                        @if( $antrian['survei'] == 1 )
                                                        <small class="text-bolder text-success">Sudah Mengisi Survei</small>
                                                        @else
                                                        <small class="text-bolder text-danger">Belum Mengisi Survei</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('sweetalert::alert')
    @include('layouts.scripts')
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Format tanggal yang diizinkan
                autoclose: true // Otomatis menutup datepicker setelah memilih tanggal
            });
        });
    </script>
</body>

</html>
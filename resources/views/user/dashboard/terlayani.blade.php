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
            @include('user.navbar.index')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between flex-column">
                            <div class="col-6">
                                <h3>Data Terlayani</h3>
                            </div>
                            <div class="text-md-end">
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
                                    <div class="col-auto">
                                        <a href="/user/dashboard/data-terlayani/cetak" type="button" class="btn btn-danger btn-sm">
                                            <i class="bi bi-filetype-pdf"></i>
                                            Cetak
                                        </a>
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
                                                    <th class="text-left">Layanan</th>
                                                    <th class="text-left">Nama</th>
                                                    <th class="text-left">Tanggal Antrian</th>
                                                    <th class="text-left">Isi Survei</th>
                                                    <th class="text-left">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($antrians as $antrian)
                                                <tr>
                                                    <td class="text-left">{{ $loop->iteration }}</td>
                                                    <td class="text-left">{{ $antrian['nama_layanan'] }}</td>
                                                    <td class="text-left">{{ $antrian['nama'] }}</td>
                                                    <td class="text-left">{{ $antrian['waktu_pelayanan'] }}</td>
                                                    <td class="text-left">
                                                        @if( $antrian['survei'] == 1 )
                                                        <small class="text-bolder text-success">Sudah</small>
                                                        @else
                                                        <small class="text-bolder text-danger">Belum</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="/user/dashboard/terlayani/detail/{{ $antrian['id'] }}" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-eye-fill"></i>
                                                            Detail
                                                        </a>
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
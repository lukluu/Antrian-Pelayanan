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
            @include('user.navbar.index')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Syarat Layanan</h3>
                            </div>
                        </div>
                        <section class="section">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped " id="table1" class="display">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Layanan</th>
                                                    <th>Syarat 1</th>
                                                    <th>Syarat 2</th>
                                                    <th>Syarat 3</th>
                                                    <th>Syarat 4</th>
                                                    <th>Syarat 5</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($layanan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_layanan }}</td>
                                                    <td>{{ $item->syarat1 }}</td>
                                                    <td>{{ $item->syarat2 }}</td>
                                                    <td>{{ $item->syarat3 }}</td>
                                                    <td>{{ $item->syarat4 }}</td>
                                                    <td>{{ $item->syarat5 }}</td>
                                                    <td>
                                                        <a href="/user/dashboard/syarat-layanan/edit/{{ $item->id }}" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                            Kelola
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
</body>
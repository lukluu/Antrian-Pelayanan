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
                                    <a href="/user/dashboard/syarat-layanan" class="btn btn-danger btn-sm">Kembali</a>
                                </div>
                            </div>
                        </div>

                        <form action="/user/dashboard/data-melayani/update/{{$layanan->id}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Keterangan</p>
                                    <div class="col-sm-8">
                                        <small class="col-form-label text-center">: {{ $layanan->nama_layanan }}</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Syarat 1</p>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="syarat1" value="{{$layanan->syarat1}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Syarat 2</p>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="syarat2" value="{{$layanan->syarat2}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Syarat 3</p>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="syarat3" value="{{$layanan->syarat3}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Syarat 4</p>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="syarat4" value="{{$layanan->syarat4}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <p class="col-sm-4 col-form-label">Syarat 5</p>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="syarat5" value="{{$layanan->syarat5}}">
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
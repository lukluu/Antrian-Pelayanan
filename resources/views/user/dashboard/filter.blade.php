@include('layouts.head')
<style>
    .active .aha {
        border: 1px solid #1e895b;
        background-color: #fff !important;
    }

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

    .input-group .form-select,
    .input-group button {
        height: 38px;
        /* Sesuaikan tinggi sesuai kebutuhan */
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

            <div class="container-fluid py-4">
                <div class="text-white text-center mb-4"><span class="text-bolder border-radius-lg bg bg-success px-4 py-2">{{$nama_layanan}}</span></div>
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-2 mb-3">
                        <div class="border-radius-lg p-2">
                            <div class="card-body text-center">
                                <small class="text-bolder"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 mb-3">
                        <a href="/user/dashboard" class="text-black {{ Request::is('user/dashboard') ? 'active' : '' }}">
                            <div class="blur aha border-radius-lg p-2">
                                <div class="card-body text-center">
                                    <small class="text-bolder">All</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-9 mb-3">
                        <div class="input-group p-0">
                            <select class="form-select" id="layanan" name="layanan" aria-label="Example select with button addon">
                                <option value="{{$layananId}}">{{$nama_layanan}}</option>
                                @foreach ($outlets as $layanan)
                                <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                                @endforeach
                            </select>
                            <a href="#" id="filterLink" class="btn btn-danger">Filter</a>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-2 col-sm-3 mb-xl-0 mb-4 custom-card p-0 shadow-xl">
                        <div class="card h-100 p-0">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h6 class="font-weight-bolder text-center m-0">
                                            Menunggu
                                        </h6>

                                        <h1 class="mt-1 w-100 h-50 border-radius-lg shadow-sm text-center bg bg-secondary text-white">
                                            {{ $antrianMenunggu }}
                                        </h1>

                                        <h6 class="font-weight-bolder text-center mt-1">
                                            Orang
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-sm-9 mb-xl-0 mb-4">
                        @foreach($antrians as $antrian)
                        <div class=" card shadow-lg mb-2">
                            <div class="card-body p-3">
                                <dsiv class="row gx-4">
                                    <div class="col-auto">
                                        <div class="avatar avatar-xl position-relative ">
                                            <h3 class="w-100 border-radius-lg shadow-sm text-center bg bg-success text-white">
                                                {{ $antrian['nomor_antrian'] }}
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 my-auto">
                                        <div class="h-100">
                                            <small class="badge bg-success font-weight-bold">
                                                {{ $antrian['nama_layanan'] }}
                                            </small>
                                        </div>
                                        <small class="text-success font-weight-bold">
                                            {{ $antrian['waktu_pelayanan'] }}
                                        </small>
                                        <small class="text-black font-weight-bold">
                                            |
                                        </small>
                                        <small class="text-success font-weight-bold">
                                            {{ $antrian['waktu'] }}
                                        </small>
                                    </div>
                                    @if(isset($antrian['waktu_mulai']))
                                    <small class="text-danger text-bolder col-auto d-flex align-items-center" id='melayani'>Sedang Dilayani</small>
                                    @endif
                                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                                        <div class="nav-wrapper position-relative end-0 d-flex justify-content-center">
                                            @if(isset($antrian['waktu_mulai']))
                                            <form method="POST" class="me-2" action="{{ route('user.dashboard.selesai', $antrian['id']) }}">
                                                @csrf
                                                <input type="hidden" name="antrian_id" value="{{ $antrian['id'] }}">
                                                <button type="submit" id="akhir" class="mb-0 badge bg-warning border-0">Akhiri</button>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('user.dashboard.layani', $antrian['id']) }}" class="me-2">
                                                @csrf
                                                <input type="hidden" name="antrian_id" value="{{ $antrian['id'] }}">
                                                <button type="submit" id="mulai" class="mb-0 badge bg-success border-0">Mulai layanan</button>
                                            </form>
                                            @endif
                                            <a href="/user/dashboard/detail/{{ $antrian['id'] }}" class="mb-0 badge bg-secondary border-0">Detail</a>
                                        </div>
                                    </div>

                                </dsiv>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <div class="col-xl-10 col-sm-9 mb-xl-0 mb-4" id="dataFilterLayanan">

                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('sweetalert::alert')
    @include('layouts.scripts')
    <script>
        document.getElementById('filterLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var layananId = document.getElementById('layanan').value;
            var baseUrl = '/user/dashboard/filter';
            var url = baseUrl + '?layanan=' + layananId;
            window.location.href = url; // Redirect to the constructed URL
        });
    </script>
</body>

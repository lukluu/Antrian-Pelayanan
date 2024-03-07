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

            <div class="container-fluid py-4">
                <div class="row">
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
                                            <h5 class="mb-1">
                                                {{ $antrian['nama'] }}
                                            </h5>
                                            <small class="badge bg-success font-weight-bold">
                                                {{ $antrian['nama_layanan'] }}
                                            </small>
                                        </div>
                                        <small class="text-success font-weight-bold">
                                            {{ $antrian['waktu_pelayanan'] }}
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
                </div>

            </div>

        </div>


        @include('layouts.scripts')
</body>

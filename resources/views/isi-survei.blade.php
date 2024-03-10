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
            <div class="col-12 mb-5">

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <marquee behavior="scroll" direction="left" scrollamount="3">
                            Silahkan isi survei Anda
                        </marquee>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">

                        @foreach($antrians as $antrian)
                        <a href="/survei/isi-survei/{{$antrian->id}}">
                            <div class=" card shadow-lg mb-2">
                                <div class="card-body py-0 px-3">
                                    <div class="row">
                                        <div class="col-auto d-flex align-items-center">
                                            <div class="avatar avatar-xl position-relative">
                                                <h3 class="w-100 border-radius-lg shadow-sm text-center bg bg-success text-white">
                                                    {{ $antrian->no_antri }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-auto my-auto d-flex align-items-center">
                                            <small class="badge bg-success font-weight-bold">
                                                {{ $antrian->outlet->nama_layanan }}
                                            </small>
                                        </div>
                                        <div class="col-auto ms-auto d-flex align-items-center">
                                            <small>Isi Survei</small>
                                            <i class="bi bi-chevron-right text-5xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        @include('layouts.scripts')
        @include('sweetalert::alert')
</body>
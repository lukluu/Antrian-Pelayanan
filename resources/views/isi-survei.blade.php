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
                <nav class="navbar navbar-expand-lg bg-white top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="">
                        <a href="/survei" class="text-dark text-2xl"><i class="bi bi-arrow-left"></i></a>
                    </div>
                    <div class="container-fluid py-3">
                        <marquee behavior="scroll" direction="left" scrollamount="10">
                            <span class="text-primary h3 mx-4">Terima kasih telah menggunakan layanan kami!</span>
                            <span class="text-primary h3 mx-4">Jangan lupa untuk mengisi survei kunjungan Anda.</span>
                        </marquee>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row mt-5 pt-5 mx-0">
            <div class="modal-body col-12 mb-3">
                <div class="bg-light p-4">
                    <label class="text-sm">Silahkan Pilih dan Ketuk Nomor Antrian Anda dan Lakukan Penilaian Kepuasan Anda</label>
                    <div class="d-flex flex-column align-items-start">
                        <small class="text-muted">Setip Penilaian Anda Selalu Berguna Untuk Meningkatkan Kualitas Pelayanan Kami, Terima Kasih</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                    @foreach($antrians as $antrian)
                    <a href="/survei/isi-survei/{{$antrian->id}}">
                        <div class="bg bg-white shadow-lg mb-2">
                            <div class="card-body py-0 px-3">
                                <div class="row d-flex align-items-center">
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="avatar avatar-xl position-relative">
                                            <h3 class="w-100 border-radius-lg shadow-sm text-center bg bg-success text-white">
                                                {{ $antrian->no_antri }}
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <small class="badge bg-success font-weight-bold">
                                            {{ $antrian->outlet->nama_layanan }}
                                        </small>
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <!-- <small class="px-2">Isi Survei</small> -->
                                        <i class="bi bi-chevron-right text-2xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
        @include('layouts.scripts')
        @include('sweetalert::alert')
</body>
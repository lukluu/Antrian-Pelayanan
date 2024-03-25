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

<link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert2.min.js') }}"></script>

<body class="bg-gray-100">
    <div class="min-height-400 bg-primary opacity-10 position-absolute w-100"></div>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row gap-3">
            <div class="col-12 mb-5">
                <nav class="navbar navbar-expand-lg bg-white top-0 z-index-3 shadow position-absolute mt-4 start-0 end-0 mx-4">
                    <div class="d-flex flex-nowrap align-items-center">
                        <a href="/survei/isi-survei" class="text-dark text-2xl"><i class="bi bi-arrow-left"></i></a>
                        <div class="container-fluid py-3">
                            <!-- Marquee -->
                            <marquee behavior="scroll" direction="left" scrollamount="10">
                                <span class="text-primary h3 mx-4">Terima kasih telah menggunakan layanan kami!</span>
                                <span class="text-primary h3 mx-4">Jangan lupa untuk mengisi survei kunjungan Anda.</span>
                            </marquee>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="container-fluid mt-5">
                <div class="modal-body mb-3">
                    <div class="bg-light p-4 rounded">
                        <label class="text-sm">Silahkan Memberi Point Pada Setiap Quisioner, Mohon <span class="text-bolder">Cermati</span> Setiap Pertanyaan</label>
                        <div class="d-flex flex-column align-items-start">
                            <small class="text-muted">Beri Penilaian anda dari rentan 1 sampai 4</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                        <form id="radioSubmitForm" action="/survei/isi-survei/{{$antrian_id}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" value="{{$survei_status}}" name="survei_status"> <!-- Input tersembunyi untuk survei_status -->
                            <input type="hidden" value="{{$antrian_id}}" name="antrian_id"> <!-- Input tersembunyi untuk antrian_id -->
                            @foreach($question as $q)
                            <input type="hidden" value="{{$q->id}}" name="survei_id[]"> <!-- Input tersembunyi untuk survei_id -->
                            <!-- Konten lainnya -->
                            <div class="card shadow-lg mb-2">
                                <div class="card-body py-3 px-3">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-auto my-auto d-flex align-items-center">
                                            <small class="badge bg-success font-weight-bold">{{ $loop->iteration }}</small>
                                        </div>
                                        <div class="col d-flex align-items-center">
                                            <small class="text-bolder">{{ $q->pertanyaan }}</small> <!-- Perbaiki $q->unsur menjadi $q->pertanyaan -->
                                        </div>
                                        <div class="col-auto ms-auto">
                                            <small>Buruk</small>
                                            <input type="hidden" value="{{ $antrian_id }}" name="antrian_id">
                                            <input type="hidden" value="1" name="survei_status">
                                            @for($i = 1; $i <= 4; $i++) <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="skor[{{ $loop->index }}]" id="skor{{ $loop->index }}_{{ $i }}" value="{{ $i }}">
                                                <label class="form-check-label" for="skor{{ $loop->index }}_{{ $i }}">{{ $i }}</label>
                                        </div>
                                        @endfor
                                        <small>Sangat Baik</small>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach
                    </form>

                </div>

            </div>
        </div>
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card shadow-lg mb-2">
                <div class="card-body py-3 px-3">
                    <div class="row d-flex align-items-center">
                        <button id="submitSurvei" type="button" class="btn btn-primary">Submit Survei</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @include('layouts.scripts')
    <script>
        document.getElementById('submitSurvei').addEventListener('click', function() {
            document.getElementById('radioSubmitForm').submit();
        });
    </script>
</body>

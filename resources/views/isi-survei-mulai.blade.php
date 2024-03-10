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
                                    <div class="row">
                                        <!-- Kolom untuk nomor pertanyaan -->
                                        <div class="col-auto my-auto d-flex align-items-center">
                                            <small class="badge bg-success font-weight-bold">{{ $loop->iteration }}</small>
                                        </div>
                                        <!-- Kolom untuk pertanyaan -->
                                        <div class="col d-flex align-items-center">
                                            <label class="h6">{{ $q->unsur }}</label> <!-- Perbaiki $q->unsur menjadi $q->pertanyaan -->
                                        </div>
                                        <!-- Kolom untuk input skor -->
                                        <div class="col-auto ms-auto">
                                            <input type="hidden" value="{{ $antrian_id }}" name="antrian_id">
                                            <input type="hidden" value="1" name="survei_status">
                                            @for($i = 1; $i <= 5; $i++) <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="skor[{{ $loop->index }}]" id="skor{{ $loop->index }}_{{ $i }}" value="{{ $i }}">
                                                <label class="form-check-label" for="skor{{ $loop->index }}_{{ $i }}">{{ $i }}</label>
                                        </div>
                                        @endfor
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
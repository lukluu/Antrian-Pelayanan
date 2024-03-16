@include('layouts.head')

<!-- <style>
    .swal2-cancel {
        display: none !important;
    }
</style> -->

<body class="g-sidenav-show bg-primary">
    <!-- <div class="min-height-300 bg-primary position-absolute w-100"></div> -->
    <div class="bg-primary">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
                <!-- <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body" type="submit" role="button"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Search..">
                        </div>
                    </div>
                </div> -->
            </div>
        </nav>
        <div class="card shadow-lg mx-4" style="border-radius: 0;">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col d-flex align-items-center">
                        <a href="/ambil-antrian" class="btn btn-secondary mt-3">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div class="col-10 ms-2">
                            <small class="h5 text-dark text-bolder">
                                {{ $instansi }}
                            </small>
                        </div>
                    </div>
                    <div class="col-auto ms-auto d-flex align-items-center mt-1">
                        <small class="h5 text-dark text-bolder">
                            Sektor {{ $sektor }}
                        </small>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                @foreach($pelayanans as $pelayanan)
                <div class="col-xl-3 col-sm-6 mb-3" role="button" data-bs-toggle="modal" data-bs-target="#modal{{ $pelayanan->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 d-flex align-items-center">
                                    <div style="background-color: #6c757d; border-radius: 50%; padding: 12px; height: 50px; width: 50px;" class="text-center d-flex justify-content-center align-items-center">
                                        <span style="font-size: 2.5em; color: #fff;">{{$loop->iteration}}</span>
                                    </div>
                                </div>

                                <div class="col-10 me-auto d-flex align-items-center ps-4">
                                    <small class="font-weight-bolder text-dark">
                                        {{ $pelayanan->nama_layanan }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left tutupModal" id="modal{{ $pelayanan->id }}" tabindex="-1" role="dialog" data-bs-backdrop="false" aria-labelledby="myModalLabel{{ $pelayanan->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center">
                                <small class="font-weight-bolder text-dark h5">
                                    {{ $pelayanan->nama_layanan }}
                                </small>
                            </div>
                            <div class="modal-body ">
                                <div class="modal-body">
                                    <div class="bg-light p-4 rounded">
                                        <label class="text-sm">Silahkan Siapkan Syarat Pelayanan, Pastikan Anda Memiliki</label>
                                        <div class="d-flex flex-column align-items-start">
                                            <small class="text-muted">1. {{ $pelayanan->syarat1 }}</small>
                                            @if($pelayanan->syarat2 != null)
                                            <small class="text-muted">2. {{ $pelayanan->syarat2 }}</small>
                                            @endif
                                            @if($pelayanan->syarat3 != null)
                                            <small class="text-muted">3. {{ $pelayanan->syarat3 }}</small>
                                            @endif
                                            @if($pelayanan->syarat4 != null)
                                            <small class="text-muted">4. {{ $pelayanan->syarat4 }}</small>
                                            @endif
                                            @if($pelayanan->syarat5 != null)
                                            <small class="text-muted">5. {{ $pelayanan->syarat5 }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr class="horizontal dark">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary btn-sm formLanjut" id="formLanjut{{ $pelayanan->id }}">Lanjut Ambil Antrian</button>
                                </div>
                                <form style="display: none;" id="myForm{{ $pelayanan->id }}" action="/submit-antrian" method="post">
                                    @csrf
                                    <input class="form-control" type="hidden" name="outlet_id" value="{{ $pelayanan->id }}">
                                    <input class=" form-control" type="hidden" name="no_antri" value="{{ $nomor }}">
                                    <input class="form-control" type="hidden" name="status" value="0">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-danger p-4 rounded" onclick="ambilAntrian()">
                                            <i class="bx bx-check d-block"></i>
                                            <span class="d-sm-block h5 text-white">Ambil Antrian</span>
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeBtn">
                                    <i class="bx bx-x d-block"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    @include('layouts.scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll(".formLanjut");
            buttons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var pelayananId = button.id.replace("formLanjut", "");
                    var form = document.getElementById("myForm" + pelayananId);

                    form.style.display = "block"; // Menampilkan elemen form
                    button.style.display = "none"; // Menyembunyikan tombol "Lanjut Ambil Antrian"
                });
            });

            var closeBtn = document.getElementById('closeBtn');
            closeBtn.addEventListener('click', function() {
                location.reload();
            });
        });
    </script>

</body>

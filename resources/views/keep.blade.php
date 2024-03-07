@include('layouts.head')


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
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body" type="submit" role="button"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Search..">
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <a href="/ambil-antrian" class="mx-4 btn btn-secondary mt-2">Kembali</a>
        <div class="card shadow-lg mx-4">
            <div class="card-body p-3 d-flex flex-column align-items-center">
                <div class="navbar-brand">
                    <h4 class="text-center">
                        SILAHKAN PILIH PELAYANAN
                    </h4>
                </div>
                <div class="col-xl-3 col-sm-12 badge bg-danger d-flex justify-content-center h5">
                    {{ $instansi }}
                </div>
            </div>

        </div>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                @foreach($pelayanans as $pelayanan)
                <div class="col-xl-3 col-sm-6 mb-xl-5 mb-4 " role="button" data-bs-toggle="modal" data-bs-target="#modal{{ $pelayanan->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="numbers">
                                        <h5 class="font-weight-bolder">
                                            {{ $pelayanan->nama_layanan }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="modal{{ $pelayanan->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{ $pelayanan->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="text-white modal-title " id="myModalLabel110">
                                    Antrian {{ $nomor }} {{ $pelayanan->nama_layanan }}
                                </h4>
                            </div>

                            <div class="modal-body ">
                                <form id="myForm" action="/submit-antrian" method="post">
                                    @csrf
                                    <input class="form-control" type="hidden" name="outlet_id" value="{{ $pelayanan->id }}">
                                    <input class=" form-control" type="hidden" name="no_antri" value="{{ $nomor }}">
                                    <input class="form-control" type="hidden" name="status" value="0">
                                    <div class="card-body">
                                        <p class="text-sm">Silahkan Isi Data Diri Terlebih Dahulu</p>
                                        <hr class="horizontal dark">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nama" class="form-control-label">Nama Lengkap</label>
                                                    <input class="form-control @error('nama')is-invalid @enderror" value="{{ old('nama') }}" type="text" name="nama" id="nama" required>

                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" class="form-control-label">NIK</label>
                                                    <input class="form-control @error('nik')is-invalid @enderror" value="{{ old('nik') }}" type="number" name="nik" id="nik" required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="no_hp" class="form-control-label">No HP</label>
                                                    <input value="{{ old('no_hp') }}" class="form-control @error('no_hp')is-invalid @enderror" type="number" name="no_hp" id="no_hp" required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="gender" class="form-control-label">Gender</label>
                                                    <select class="form-control @error('gender')is-invalid @enderror" id="gender" name="gender" required>
                                                        <option>--</option>
                                                        <option value="laki-laki">Laki-laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pekerjaan" class="form-control-label">Pekerjaan</label>
                                                    <input value="{{ old('pekerjaan') }}" class="form-control @error('pekerjaan')is-invalid @enderror" id="pekerjaan" type="text" name="pekerjaan" required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat" class="form-control-label">Alamat</label>
                                                    <input value="{{ old('alamat') }}" id="alamat" class="form-control @error('alamat')is-invalid @enderror" type="text" name="alamat" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kelurahan" class="form-control-label">Kelurahan/Desa</label>
                                                    <input value="{{ old('kelurahan') }}" id="kelurahan" class="form-control @error('kelurahan')is-invalid @enderror" type="text" name="kelurahan" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kecamatan" class="form-control-label">Kecamatan</label>
                                                    <input class="form-control @error('kecamatan')is-invalid @enderror" value="{{ old('kecamatan') }}" id="kecamatan" type="text" name="kecamatan" required>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary col-12 mt-4">
                                        <i class="bx bx-check d-block"></i>
                                        <span class="d-sm-block">Ambil Antrian</span>
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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

</body>
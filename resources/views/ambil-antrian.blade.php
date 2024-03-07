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
        <a href="/" class="mx-4 btn btn-secondary mt-2">Kembali</a>
        <div class="card shadow-lg mx-4">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col">
                        <div class="navbar-brand d-flex justify-content-center">
                            <h4 class="text-center">
                                SILAHKAN PILIH PELAYANAN
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                @foreach($instansis as $instansi)
                <a href="/keep-antrian/{{ $instansi->id }}" class="col-xl-3 col-sm-6 mb-xl-5 mb-4 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-7 d-flex justify-content-center">
                                    <div class="numbers">
                                        <h5 class="font-weight-bolder">
                                            {{ $instansi->name }}
                                        </h5>
                                        <hr class="horizontal dark">
                                        <p>{{ $instansi->nama_kepanjangan }}</p>
                                    </div>
                                </div>
                                <div class="col-5 d-flex justify-content-end">
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

    @include('sweetalert::alert')
    @include('layouts.scripts')

</body>
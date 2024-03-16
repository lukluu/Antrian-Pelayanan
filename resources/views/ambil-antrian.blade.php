@include('layouts.head')

<style>
    .active .aha {
        background-color: slategrey !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        color: white;
        border: white 1px solid;
    }

    .card {
        display: flex;
        flex-direction: column;
        height: 100%;

        /* Ensure the card takes full height of its parent */
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* Menengahkan konten secara vertikal */

        /* Menengahkan konten secara horizontal */
    }

    .card-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        /* Menengahkan kartu secara horizontal */
    }

    /* Ensure all cards within a row stretch to the height of the tallest card */
    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .row>.col-xl-3 {
        display: flex;
    }

    .row .card {
        flex: 1;
    }

    .no-border-radius {
        border-radius: 5px !important;
        /* Remove border radius */
    }

    @media (max-width: 576px) {
        #title {
            font-size: 1rem;
            /* Atur ukuran font menjadi 1.25rem untuk perangkat berukuran hp */
        }
    }
</style>

<body class="g-sidenav-show bg-primary">

    <!-- <div class="min-height-300 bg-primary position-absolute w-100"></div> -->
    <div class="bg-primary">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm text-white" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </nav>
        <div class="card shadow-lg mx-4 d-flex flex-row" style="border-radius: 0;">
            <div class="card-header p-3"> <!-- Gunakan card header untuk menempatkan tombol -->
                <a href="/" class="btn btn-secondary mt-2" style="margin-right: auto;">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="card-body">
                <h5 id="title" class="text-bolder text-black">
                    SILAHKAN PILIH PELAYANAN
                </h5>
            </div>
            <div class="card-footer">

            </div>
        </div>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <a href="/ambil-antrian?sektor=1" class="col-3 mb-3 col-sm-3 text-black card-link @if(request('sektor') == 1) active @endif">
                    <div class="blur aha border-radius-lg p-3">
                        <div class="card-body text-center">
                            <small class="text-bolder">Sektor 1</small>
                        </div>
                    </div>
                </a>
                <a href="/ambil-antrian?sektor=2" class="col-3 mb-3 col-sm-3 text-black card-link @if(request('sektor') == 2) active @endif">
                    <div class="blur aha border-radius-lg p-3">
                        <div class="card-body text-center d-flex justify-content-center">
                            <small class="text-bolder">Sektor 2</small>
                        </div>
                    </div>
                </a>
                <a href="/ambil-antrian?sektor=3" class="col-3 mb-3 col-sm-3 text-black card-link @if(request('sektor') == 3) active @endif">
                    <div class="blur aha border-radius-lg p-3">
                        <div class="card-body text-center">
                            <small class="text-bolder">Sektor 3</small>
                        </div>
                    </div>
                </a>
                <a href="/ambil-antrian?sektor=4" class="col-3 mb-3 col-sm-3 text-black card-link @if(request('sektor') == 4) active @endif">
                    <div class="blur aha border-radius-lg p-3">
                        <div class="card-body text-center">
                            <small class="text-bolder">Sektor 4</small>
                        </div>
                    </div>
                </a>
            </div>
            <a href="/ambil-antrian" class="col-3 mb-3 col-sm-3 text-black card-link">
                <div class="blur aha border-radius-lg p-3">
                    <div class="card-body text-center">
                        <small class="text-bolder">Semua</small>
                    </div>
                </div>
            </a>
            <hr class="horizontal light mt-4">
            <div class="row card-row">
                @foreach($instansis as $instansi)
                <a href="/keep-antrian/{{ $instansi->id }}" class="col-xl-3 col-md-4 col-sm-6  mb-3 text-decoration-none">
                    <div class="card no-border-radius">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-3">
                                    @if($instansi->logo == null)
                                    <img src="{{asset('img/logo-instansi/kota.png')}}" alt="" class="img-fluid">
                                    @else
                                    <img src="{{asset('img/logo-instansi/'.$instansi->logo)}}" alt="" class="img-fluid">
                                    @endif
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <h6 class="font-weight-bolder m-0 p-0">
                                            {{ $instansi->name }}
                                        </h6>
                                        <p class="">{{ $instansi->nama_kepanjangan }}</p>
                                        <hr class="horizontal dark m-0">
                                        <small class="text-bolder">Sektor {{ $instansi->sektor }}</small>
                                    </div>
                                </div>
                                <div class="col-2 d-flex justify-content-end">
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

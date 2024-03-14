@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-5 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Antrian Hari ini</p>
                            <h1 class="font-weight-bolder">
                                {{ $antrianaHariIni->count() }}
                            </h1>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-sm-6 mb-xl-0">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Telah Di Layani Hari Ini</p>
                            <h1 class="font-weight-bolder">
                                {{ $melayaniHariIni }}
                            </h1>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 mb-xl-0">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ $hariSekarang }}</p>
                            <h6 class="font-weight-bolder">
                                <span id="jam"></span>
                            </h6>
                            <small class="badge bg-success">{{ $jamSekarang }} </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 mb-1">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4">Terbanyak Minggu ini</h6>
                <div class="list-group list-group-flush">
                    @foreach($layananTeratas as $index => $layanan)
                    <div class="list-group-item bg-light mb-2 p-2 rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-success">{{$index+1}}</span>
                                <span class="ms-2">{{$layanan->outlet->nama_layanan}}</span>
                            </div>
                            <span class="text-bolder">{{$layanan->total}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

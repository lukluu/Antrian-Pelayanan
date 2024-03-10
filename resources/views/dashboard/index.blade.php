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
    <div class="col-lg-3 mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-2">Terbanyak Hari Ini</h6>
                </div>
                <i class="fa-light fa-arrow-trend-up text-success"></i>
                <span class="font-weight-bold"></span> in {{ $jamSekarang }}
            </div>
            <div class="table-responsive">
                <table class="table align-items-center ">
                    <tbody>
                        <tr>
                            <td class="w-10">
                                <div class="d-flex px-2 py-1 align-items-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h5 class="text-center badge bg-success">1</h5>
                                    </div>
                                    <div class="ms-4">
                                        <h6 class="text-sm mb-0"></h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <h6 class="text-sm mb-0"></h6>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
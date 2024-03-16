@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="back m-2 mb-0">
                <a href="/dashboard/data-antrian" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="card-header pb-0">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <a href="/dashboard/data-antrian" class="btn btn-danger btn-sm">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <p class="col-sm-4 col-form-label">Keterangan</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $antrian->outlet->nama_layanan }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">Nomor Antrian</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $antrian->no_antri }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">Nama</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $antrian->nama }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">NIK</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $antrian->nik }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">Jenis Kelamin</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $antrian->jkl }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">Pendidikan Terakhir</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $antrian->pendidikan }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">Tanggal Ambil Antrian</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $antrian->created_at }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">Durasi Pelayanan</p>
                    <div class="col-sm-8">
                        <small class="col-form-label text-center">: {{ $durasi }}</small>
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4 col-form-label">Status Survei</p>
                    <div class="col-sm-8">
                        @if( $antrian->survei == 1 )
                        <small class="text-bolder text-success">: Sudah Mengisi</small>
                        @else
                        <small class="text-bolder text-danger">: Belum Mengisi</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
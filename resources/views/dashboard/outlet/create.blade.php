@extends('layouts.main')
<style>
    select {
        padding-right: 25px;
        /* Tambahkan padding untuk anak panah */
    }

    select:after {
        content: "";
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        border-width: 0 5px 5px 0;
        border-color: transparent transparent black transparent;
        pointer-events: none;
    }
</style>
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="back m-2 mb-0">
                <a href="/dashboard/data-instansi" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="card-header pb-0">
                <div class="d-flex justify-content-center">
                    <h3 class="mb-0 text-center">Tambah Outlet</h3>
                </div>
            </div>
            <form action="/dashboard/data-instansi/tambah-instansi" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Panjang Instansi</label>
                                <input value="{{ old('nama_kepanjangan') }}" class="form-control @error('nama_kepanjangan)is-invalid @enderror" type="text" name="nama_kepanjangan">
                                @error('nama_kepanjangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Singkatan</label>
                                <input value="{{ old('name') }}" class="form-control @error('name')is-invalid @enderror" type="text" name="name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Kode Instansi</label>
                                <input value="{{ old('kode') }}" class="form-control @error('kode') is-invalid @enderror" type="text" id="kode" name="kode">
                                @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Pilih Staff</label>
                                <select class="form-select" id="example-select" name="user_id">
                                    <option value="">Pilih Staf</option>
                                    @foreach($stafs as $staf)
                                    @if($loop->index === 0)
                                    @continue
                                    @endif
                                    <option value="{{ $staf->id }}">{{ $staf->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sektor" class="form-control-label">Zona</label>
                                <select class="form-select" name="sektor" id="sektro">
                                    <option value="">Pilih Zona</option>
                                    @for ($i = 1; $i <= 4; $i++) <option value="{{ $i }}">Zona {{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                    </div>
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Tambahkan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection

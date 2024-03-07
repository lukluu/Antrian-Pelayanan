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
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">Tambah Outlet</p>
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
                            <label for="example-select" class="form-control-label">Kode</label>
                            <div class="input-group">
                                <select class="form-control" id="example-select" name="kode">
                                    @foreach(range('A', 'Z') as $huruf)
                                    @if (!in_array($huruf, $kodes))
                                    <option value="{{ $huruf }}">{{ $huruf }}</option>
                                    @endif
                                    @endforeach
                                </select>

                                <button class="badge btn-outline-secondary border-0" type="button" id="toggleDropdown">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
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
                                <select class="form-control" id="example-select" name="user_id">
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

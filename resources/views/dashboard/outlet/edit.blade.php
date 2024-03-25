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
                    <small class="text-bolder mb-0 h5">Edit Instansi <span class="text-uppercase">{{ $instansi->name }}</span></small>
                </div>
            </div>
            <form method="POST" action="{{ route('dashboard.data-instansi.edit', $instansi->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_kepanjangan" class="form-control-label">Nama Panjang Instansi</label>
                                <input value="{{ old('nama_kepanjangan', $instansi->nama_kepanjangan) }}" class="form-control @error('nama_kepanjangan') is-invalid @enderror" type="text" id="nama_kepanjangan" name="nama_kepanjangan">
                                @error('nama_kepanjangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nama Singkatan</label>
                                <input value="{{ old('name', $instansi->name) }}" class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Kode Instansi</label>
                                <input value="{{ old('kode', $instansi->kode) }}" class="form-control @error('kode') is-invalid @enderror" type="text" id="kode" name="kode">
                                @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sektor" class="form-control-label">Zona</label>
                                <select class="form-select" name="sektor" id="sektro">
                                    @for ($i = 1; $i <= 4; $i++) <option value="{{ $i }}" {{ $instansi->sektor == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id" class="form-control-label">Pilih Staff</label>
                                <select class="form-select" id="user_id" name="user_id">
                                    @if($stafs)
                                    @foreach($stafs as $staf)
                                    @if($staf->role !== 'admin')
                                    <option value="{{ $staf->id }}" @if($staf->id === $currentStafId) selected @endif>{{ $staf->name }}</option>
                                    @endif
                                    @endforeach
                                    @endif
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
                                <label for="logo" class="form-control-label">Logo Instansi</label>
                                @if ($instansi->logo)
                                <div>
                                    <img src="{{ asset('img/logo-instansi/' . $instansi->logo) }}" alt="Current Logo" style="max-width: 200px;">
                                </div>
                                @endif
                                <input class="form-control-file @error('logo') is-invalid @enderror" type="file" id="logo" name="logo">
                                @error('logo')
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
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @include('sweetalert::alert')
    @endsection

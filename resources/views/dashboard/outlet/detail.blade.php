@extends('layouts.main')


@section('container')
<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header pb-0 p-3 d-flex">
            <div class="m-auto flex-grow-1">
                <h3 class="mb-0 text-bolder">Layanan {{ $nama_instansi }}</h3>
                <small class="mb-0 text-bolder">{{ $nama_panjang }}</small>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-pelayanan">Tambah Layanan</button>
        </div>
        <div class="card-body p-3">
            <ul class="list-group">
                @foreach($layanans as $layanan)
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg align-items-center">
                    <div class="d-flex flex-column">
                        <h1 class="text-sm">{{ $layanan['name'] }}</h1>
                    </div>
                    <div class="ms-auto text-end">
                        <form id="hapus-layanan" action="{{ route('dashboard.data-instansi.detail', $layanan['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmSave('<?php echo $layanan['name'] ?>')" class="btn btn-link text-danger text-gradient px-3 mb-0"><i class="bi bi-trash"></i>Delete</button>
                            <button type="button" class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal-{{ $layanan['id'] }}"><i class="bi bi-pencil-fill"></i>Edit</button>
                        </form>
                    </div>
                    <!-- modal edit -->
                    <div class="modal fade" id="modal-{{ $layanan['id'] }}" tabindex="-1" aria-labelledby="modal-{{ $layanan['id'] }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h4 class="text-white modal-title" id="modal-{{ $layanan['id'] }}Label">Edit Nama Layanan</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditLayanan" action="/dashboard/data-instansi/detail/edit-layanan/{{ $layanan['id'] }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $layanan['id'] }}">
                                        <div class="form-group">
                                            <label for="nama_layanan" class="form-label">Nama Layanan</label>
                                            <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="{{ $layanan['name'] }}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="modal fade text-left" id="modal-pelayanan" tabindex="-1" role="dialog" aria-labelledby="modal-pelayanan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="text-white modal-title " id="myModalLabel110">
                            Isi Nama Layanan
                        </h4>
                    </div>

                    <div class="modal-body ">
                        <form id="submit-layanan" action="/dashboard/data-instansi/submit-layanan" method="post">
                            @csrf
                            <input type="hidden" name="instansi_id" value="{{ $instansi_id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama" class="form-control-label">Nama Layanan</label>
                                        <input class="form-control @error('nama_layanan')is-invalid @enderror" value="{{ old('nama_layanan') }}" type="text" name="nama_layanan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-x d-block"></i>
                                    <span class="d-sm-block">Submit</span>
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block"></i>
                                    <span class="d-none d-sm-block">Batal</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal edit -->
        <div class="modal fade text-left" id="modal-pelayanan" tabindex="-1" role="dialog" aria-labelledby="modal-pelayanan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="text-white modal-title " id="myModalLabel110">
                            Isi Nama Layanan
                        </h4>
                    </div>

                    <div class="modal-body ">
                        <form id="submit-layanan" action="/dashboard/data-instansi/submit-layanan" method="post">
                            @csrf
                            <input type="hidden" name="instansi_id" value="{{ $instansi_id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama" class="form-control-label">Nama Layanan</label>
                                        <input class="form-control @error('nama_layanan')is-invalid @enderror" value="{{ old('nama_layanan') }}" type="text" name="nama_layanan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-x d-block"></i>
                                    <span class="d-sm-block">Submit</span>
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block"></i>
                                    <span class="d-none d-sm-block">Batal</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmSave(layanan) {
            Swal.fire({
                title: 'Yakin Mau Hapus ' + layanan + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Ok',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Handle confirmed action here
                    document.getElementById("hapus-layanan").submit();
                }
            });
        }
    </script>
    @include('sweetalert::alert')
    @endsection

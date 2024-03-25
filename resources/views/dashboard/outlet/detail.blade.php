@extends('layouts.main')


@section('container')
<div class="col-md-12 mt-4">
    <div class="card">
        <div class="back m-2 mb-0">
            <a href="/dashboard/data-instansi" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
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
                    <div class="">
                        <h6 class="text-bolder">{{ $layanan['name'] }}</h6>
                        <small class="">Syarat Layanan: </small>
                        <small class="mb-0 text-xs">{{ $layanan['syarat1'] }}</small>
                        @if($layanan['syarat2'] != null)
                        <small class="mb-0 text-xs">| {{ $layanan['syarat2'] }}</small>
                        @endif
                        @if($layanan['syarat3'] != null)
                        <small class="mb-0 text-xs">| {{ $layanan['syarat3'] }}</small>
                        @endif
                        @if($layanan['syarat4'] != null)
                        <small class="mb-0 text-xs">| {{ $layanan['syarat4'] }}</small>
                        @endif
                        @if($layanan['syarat5'] != null)
                        <small class="mb-0 text-xs">| {{ $layanan['syarat5'] }}</small>
                        @endif
                    </div>
                    <div class="ms-auto text-end">
                        <form id="hapus-layanan" action="{{ route('dashboard.data-instansi.detail', $layanan['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmSave('<?php echo $layanan['name'] ?>')" class="btn btn-link text-danger text-gradient px-3 mb-0"><i class="bi bi-trash"></i>Delete</button>
                            <button type="button" class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal-{{ $layanan['id'] }}"><i class="bi bi-pencil-fill"></i>Edit</button>
                        </form>
                    </div>
                    <div class="aktif">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="aktifSwitch-{{ $layanan['id'] }}" onchange="updateAktif(this)" data-layanan-id="{{ $layanan['id'] }}" {{ $layanan['status'] == 1 ? 'checked' : '' }}>
                        </div>
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
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $layanan['id'] }}">
                                        <div class="form-group">
                                            <label for="nama_layanan" class="form-label">Nama Layanan</label>
                                            <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="{{ $layanan['name'] }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="syarat1" class="form-label">Syarat 1 Layanan</label>
                                            <input type="text" class="form-control" id="syarat1" name="syarat1" value="{{ $layanan['syarat1'] }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="syarat2" class="form-label">Syarat 2 Layanan</label>
                                            <input type="text" class="form-control" id="syarat2" name="syarat2" value="{{ $layanan['syarat2'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="syarat3" class="form-label">Syarat 3 Layanan</label>
                                            <input type="text" class="form-control" id="syarat3" name="syarat3" value="{{ $layanan['syarat3'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="syarat4" class="form-label">Syarat 4 Layanan</label>
                                            <input type="text" class="form-control" id="syarat4" name="syarat4" value="{{ $layanan['syarat4'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="syarat5" class="form-label">Syarat 5 Layanan</label>
                                            <input type="text" class="form-control" id="syarat5" name="syarat5" value="{{ $layanan['syarat5'] }}">
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="syarat1" class="form-control-label">Syarat 1 Layanan</label>
                                        <input class="form-control @error('syarat1')is-invalid @enderror" value="{{ old('syarat1') }}" type="text" name="syarat1" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="syarat2" class="form-control-label">Syarat 2 Layanan</label>
                                        <input class="form-control @error('syarat2')is-invalid @enderror" value="{{ old('syarat2') }}" type="text" name="syarat2">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="syarat3" class="form-control-label">Syarat 3 Layanan</label>
                                        <input class="form-control @error('syarat3')is-invalid @enderror" value="{{ old('syarat3') }}" type="text" name="syarat3">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="syarat5" class="form-control-label">Syarat 4 Layanan</label>
                                        <input class="form-control @error('syarat4')is-invalid @enderror" value="{{ old('syarat4') }}" type="text" name="syarat4">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="syarat5" class="form-control-label">Syarat 5 Layanan</label>
                                        <input class="form-control @error('syarat5')is-invalid @enderror" value="{{ old('syarat5') }}" type="text" name="syarat5">
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

        function updateAktif(checkbox) {
            let aktif = checkbox.checked ? 1 : 0;
            let layananId = checkbox.getAttribute('data-layanan-id');

            fetch(`/outlet/${layananId}/update-aktif`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: aktif
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle response data if needed
                    console.log(data);
                })
                .catch(error => {
                    console.error('There was an error!', error);
                    // Jika terjadi kesalahan, kembalikan status checkbox ke sebelumnya
                    checkbox.checked = !checkbox.checked;
                });
        }
    </script>
    @include('sweetalert::alert')
    @endsection

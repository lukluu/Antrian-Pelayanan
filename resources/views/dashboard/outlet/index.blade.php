@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">

            <div class="card-header pb-0">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6 order-md-1 order-last">
                        <h3>Data Outlet</h3>
                    </div>
                    <div class="col-md-6 order-md-2 text-md-end">
                        <a href="/dashboard/data-instansi/tambah-instansi" class="btn btn-primary">Tambah Outlet</a>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-striped text-black" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Instansi</th>
                                    <th>Sektor</th>
                                    <th>Code</th>
                                    <th>Staf</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($outlets as $instansi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $instansi->name }}</td>
                                    <td>Sektor {{ $instansi->sektor }}</td>
                                    <td>{{ $instansi->kode }}</td>
                                    @if($instansi->User)
                                    <td>{{ $instansi->user['name'] }}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="aktifSwitch-{{ $instansi->id }}" onchange="updateAktif(this)" data-instansi-id="{{ $instansi->id }}" {{ $instansi->aktif == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-between">
                                        <a href="/dashboard/data-instansi/edit/{{ $instansi->id }}" class="badge bg-warning">
                                            <i class="bi bi-pencil-square text-black"></i>
                                        </a>
                                        <form id="hapus-instansi-{{ $instansi->id }}" action="{{ route('dashboard.data-instansi.delete', $instansi->id) }}" method="POST" class="border-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmSave('{{ $instansi->name }}', '{{ $instansi->id }}')" class="badge bg-danger border-0"><i class="bi bi-trash3-fill color-danger"></i></button>
                                        </form>
                                        <a href="/dashboard/data-instansi/detail/{{ $instansi->id }}" class="badge bg-success">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    function updateAktif(checkbox) {
        let aktif = checkbox.checked ? 1 : 0;
        let instansiId = checkbox.getAttribute('data-instansi-id');

        fetch(`/instansi/${instansiId}/update-aktif`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    aktif: aktif
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


    function confirmSave(instansi, instansiId) {
        Swal.fire({
            title: 'Hapus Instansi ' + instansi + ' ?',
            showCancelButton: true,
            confirmButtonText: 'Ok',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Handle confirmed action here
                document.getElementById("hapus-instansi-" + instansiId).submit();
            }
        });
    }
</script>
@include('sweetalert::alert')
@endsection

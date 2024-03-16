@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6 order-md-1 ">
                        <h3>Data Staff Gerai</h3>
                    </div>
                    <div class="col-md-6 order-md-2 text-md-end">
                        <a href="/dashboard/data-user/tambah-user" class="btn btn-primary">Tambah Pegawai Outler</a>
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Instansi</th>
                                    <th>role</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                @if($loop->index === 0)
                                @continue
                                @endif
                                <tr>
                                    <td>{{ $loop->iteration-1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->instansi->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <div class="nav-wrapper position-relative end-0 d-flex justify-content-center">
                                            <a href="/dashboard/data-user/edit/{{$user->id}}" class="badge bg-warning me-2"><i class="bi bi-pencil-square text-black"></i></a>
                                            <form id="hapus-user-{{ $user->id }}" action="{{ route('dashboard.data-user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="badge bg-danger border-0" onclick="confirmSave('{{ $user->name }}', '{{ $user->id }}')"><i class="bi bi-trash3-fill color-danger"></i></button>
                                            </form>
                                        </div>
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


@include('sweetalert::alert')
<script>
    function confirmSave(user, userId) {
        Swal.fire({
            title: 'Hapus Staff ' + user + ' ?',
            showCancelButton: true,
            confirmButtonText: 'Ok',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Handle confirmed action here
                document.getElementById("hapus-user-" + userId).submit();
            }
        });
    }
</script>

@endsection

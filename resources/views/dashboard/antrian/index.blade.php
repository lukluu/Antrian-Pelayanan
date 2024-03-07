@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pengunjung</h3>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped " id="table1" class="display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Antrian</th>
                                        <th>Outlet</th>
                                        <th>Waktu Pelayanan</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>No HP</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Gender</th>
                                        <th>Alamat</th>
                                        <th>Kelurahan</th>
                                        <th>Kecamatan</th>
                                        <th>Pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($antrians as $antri)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $antri->no_antri }}</td>
                                        <td>{{ $antri->outlet->name }}</td>
                                        <td>{{ $antri->created_at }}</td>
                                        <td>{{ $antri->nama }}</td>
                                        <td>{{ $antri->nik }}</td>
                                        <td>{{ $antri->no_hp}}</td>
                                        <td>{{ $antri->ttl }}</td>
                                        <td>{{ $antri->gender }}</td>
                                        <td>{{ $antri->alamat }}</td>
                                        <td>{{ $antri->kelurahan }}</td>
                                        <td>{{ $antri->kecamatan }}</td>
                                        <td>{{ $antri->pekerjaan }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
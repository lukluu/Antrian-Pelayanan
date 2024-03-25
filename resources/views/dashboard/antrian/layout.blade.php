<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        @media print {

            #printButton,
            #printExcelButton,
            .back {
                display: none;
            }
        }
    </style>


</head>

<body>
    <div class="p-5">
        @if (count($antrians) > 0)
        @if($instansi)
        @php
        $instansiModel = App\Models\Instansi::find($instansi);
        @endphp
        @if($instansiModel)
        <h3 class="text-center">Daftar Antrian {{ $instansiModel->name }}</h3>
        @endif
        @else
        <h3 class="text-center">Daftar Antrian Semua Layanan</h3>
        @endif


        <div class="row mb-3">
            <div class="col-md-6 text-start">
                <div class="mt-2">
                    <a href="/dashboard/data-antrian/cetak" class="btn btn-primary back">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="mt-2 print-button">
                    <button class="btn btn-danger" id="printButton">
                        <i class="bi bi-printer-fill"></i> Cetak PDF
                    </button>
                    <!-- <button class="btn btn-success ms-2" id="printExcelButton">
                        <i class="bi bi-file-excel"></i> Cetak Excel
                    </button> -->
                </div>
            </div>
        </div>




        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Instansi</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Pendidikan</th>
                    <th>Status Terlayani</th>
                    <th>Survei</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($antrians as $index => $antrian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($antrian['created_at'])->format('d-m-Y') }}</td>
                    <td>{{ $antrian['outlet']['nama_layanan'] }}</td> <!-- Mengakses nested array 'outlet' dan kemudian 'nama_layanan' -->
                    <td>{{ $antrian['outlet']['instansi']['name'] }}</td> <!-- Mengakses nested array 'outlet', 'instansi', dan kemudian 'name' -->
                    <td>{{ $antrian['nama'] }}</td> <!-- Menggunakan key 'nama' dari array -->
                    <td>{{ $antrian['jkl'] }}</td> <!-- Menggunakan key 'jkl' dari array -->
                    <td>{{ $antrian['pendidikan'] }}</td> <!-- Menggunakan key 'pendidikan' dari array -->
                    <td>{{ $antrian['status'] ? 'Terlayani' : 'Tidak' }}</td> <!-- Menggunakan key 'status' dari array -->
                    <td>{{ $antrian['survei'] ? 'Terisi' : 'Kosong' }}</td> <!-- Menggunakan key 'survei' dari array -->
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(request('start_date') && request('end_date'))
        <div class="text-center"><strong>Periode :</strong> {{ request('start_date') }} - {{ request('end_date') }}</div>
        @elseif(!empty($antrians))
        <div class="text-center"><strong>Periode :</strong> {{ \Carbon\Carbon::parse($antrians[0]['created_at'])->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($antrians[count($antrians) - 1]['created_at'])->format('d-m-Y') }}</div>
        @endif



        <div class="mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title font-italic">Statistik Antrian</h5>
                                <ul class="list-group list-group-flush d-flex flex-row">
                                    <li class="list-group-item mr-3">Total Antrian: {{ count($antrians) }}</li>
                                    <li class="list-group-item mr-3">Total Terlayani: {{ collect($antrians)->where('status', 1)->count() }}</li>
                                    <li class="list-group-item mr-3">Total Survei Terisi: {{ collect($antrians)->where('survei', 1)->count() }}</li>
                                    <li class="list-group-item mr-3">Laki-laki: {{ collect($antrians)->where('jkl', 'Laki-Laki')->count() }}</li>
                                    <li class="list-group-item">Perempuan: {{ collect($antrians)->where('jkl', 'Perempuan')->count() }}</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistik Pendidikan</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">SD: {{ collect($antrians)->where('pendidikan', 'SD')->count() }}</li>
                                        <li class="list-group-item">SMP: {{ collect($antrians)->where('pendidikan', 'SMP')->count() }}</li>
                                        <li class="list-group-item">SMA: {{ collect($antrians)->where('pendidikan', 'SMA')->count() }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">DIII: {{ collect($antrians)->where('pendidikan', 'DIII')->count() }}</li>
                                        <li class="list-group-item">S1: {{ collect($antrians)->where('pendidikan', 'S1')->count() }}</li>
                                        <li class="list-group-item">S2: {{ collect($antrians)->where('pendidikan', 'S2')->count() }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">S3: {{ collect($antrians)->where('pendidikan', 'S3')->count() }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    @if(request('nama_layanan') == null && request('instansi')==null)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistik Layanan</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Total Instansi: {{ collect($antrians)->where('no_antri', '!=', 0)->unique('outlet.instansi_id')->count() }}</li>
                                <li class="list-group-item">Total Layanan: {{ collect($antrians)->where('no_antri', '!=', 0)->pluck('outlet.nama_layanan')->unique()->count() }}</li>
                            </ul>
                        </div>
                    </div>
                    @else
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistik Layanan</h5>
                            <ul class="list-group list-group-flush">
                                @php
                                $layananTerpakai = collect($antrians)->where('no_antri', '!=', 0)->pluck('outlet.nama_layanan')->unique();
                                @endphp
                                @foreach($layananTerpakai as $layanan)
                                <li class="list-group-item">{{ $layanan }}: {{ collect($antrians)->where('no_antri', '!=', 0)->where('outlet.nama_layanan', $layanan)->count() }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>


        @else
        <p class="text-center">Tidak ada data yang ditemukan.</p>
        @endif
    </div>
    <script>
        window.onload = function() {
            document.getElementById('printButton').onclick = function() {
                window.print();
            };
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
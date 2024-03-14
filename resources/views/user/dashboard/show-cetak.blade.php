@include('layouts.head')
<style>
    .custom-margin {
        margin-top: 7em;
    }

    .custom-card {
        height: 300px;
        /* Atur tinggi card sesuai kebutuhan */
    }

    @media (max-width: 700px) {
        .custom-card {
            height: auto;
            /* Mengatur tinggi card menjadi otomatis */
        }
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        top: calc(100% + 5px);
        margin-top: 0;
        /* Sesuaikan jarak vertikal antara tombol profil dan dropdown */
        min-width: 150px;
        /* Sesuaikan lebar minimum dropdown */
    }

    .dropdown-menu.show {
        display: block;
    }

    .nav-link {
        cursor: pointer;
        /* Menjadikan pointer ketika dihover untuk menandakan klik */
    }

    .dropdown-toggle::after {
        display: none !important;
    }

    .profile-icon {
        display: inline-block;
        width: 32px;
        /* Sesuaikan ukuran ikon sesuai kebutuhan */
        height: 32px;
        /* Sesuaikan ukuran ikon sesuai kebutuhan */
        border-radius: 50%;
        /* Membuat ikon berbentuk lingkaran */
        background-color: #ccc;
        /* Warna latar belakang ikon */
        background-image: url('/assets2/assets/images/faces/1.jpg');
        /* URL gambar profil */
        background-size: cover;
        /* Mengisi area ikon tanpa merubah proporsi */
    }
</style>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


<body class="bg-gray-100">
    <div class="min-height-400 bg-primary opacity-10 position-absolute w-100"></div>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            @include('user.navbar.index')
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <a href="/user/dashboard/terlayani" class="btn btn-danger btn-sm me-auto">Kembali</a>
                        </div>
                        <h3 class="text-center">Cetak Data Antrian</h3>
                    </div>

                    <div class="card-body ">
                        <form action="/user/dashboard/data-terlayani/mulai-cetak/" method="GET" class="">
                            <div class="row mb-2 d-flex justify-content-center">
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control datepicker " placeholder="Mulai" value="{{ old('start_date') }}" name="start_date" autocomplete="off" />
                                    <label>Start Date</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control datepicker" placeholder="Akhir" value="{{ old('end_date') }}" name="end_date" autocomplete="off" />
                                    <label>End Date</label>
                                </div>
                            </div>
                            <div class="row mb-2 d-flex justify-content-center">
                                <div class="form-floating col-3">
                                    <select class="form-select" id="layanan" name="nama_layanan" aria-label="Floating label select example">
                                        <option value="">Semua</option>
                                        @foreach($layanan as $layananItem)
                                        <option value="{{ $layananItem->id }}" {{ old('nama_layanan') == $layananItem->id ? 'selected' : '' }}>
                                            {{ $layananItem->nama_layanan }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="layanan">Layanan</label>
                                </div>


                                <div class="form-floating col-3">
                                    <select class="form-select" id="floatingSelect" name="jkl" aria-label="Floating label select example">
                                        <option value="">Semua</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <label for="floatingSelect">Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="row mb-2 d-flex justify-content-center">
                                <div class="form-floating col-3">
                                    <select class="form-select" id="floatingSelect" name="pendidikan" aria-label="Floating label select example">
                                        <option value="">Semua</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="DIII">DIII</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    <label for="floatingSelect">Pendidikan</label>
                                </div>
                                <div class="form-floating col-3">
                                    <select class="form-select" id="floatingSelect" name="survei" aria-label="Floating label select example">
                                        <option value="">Semua</option>
                                        <option value="1">Terisi</option>
                                        <option value="0">Kosong</option>
                                    </select>
                                    <label for="floatingSelect">Status Survei</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm">fiter</button>
                                </div>
                            </div>

                        </form>
                        <!-- Setelah form filter -->
                        <div class="row mt-4 mb-5">
                            <div class="col-12">
                                @if (!empty($antrians))
                                <h4>Hasil Filter:</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered col-12" id="myTable">
                                        <thead>
                                            <tr>
                                                <!-- Sesuaikan dengan kolom-kolom data yang ingin ditampilkan -->
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Layanan</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Pendidikan</th>
                                                <th>Survei</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($antrians as $index => $antrian)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $antrian->created_at }}</td>
                                                <td>{{ $antrian->outlet->nama_layanan }}</td>
                                                <td>{{ $antrian->nama }}</td>
                                                <td>{{ $antrian->jkl }}</td>
                                                <td>{{ $antrian->pendidikan }}</td>
                                                <td>{{ $antrian->survei ? 'Terisi' : 'Kosong' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" onclick="printTable()" class="btn btn-danger btn-sm">
                                        <i class="bi bi-printer"></i> cetak</button>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.scripts')
    @if (!empty($antrians))
    <script>
        function printTable() {
            // Ambil elemen tabel
            const table = document.getElementById('myTable');
            // Konfigurasi opsi untuk konversi PDF
            const opt = {
                margin: 0.5,
                filename: '{{ $instansi }}-data-unduh-{{ Carbon\Carbon::now()->format("d-m-Y") }}.pdf',
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'landscape'
                }
            };
            // Konversi tabel HTML menjadi PDF
            html2pdf().from(table).set(opt).save();
        }
    </script>
    @endif
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Format tanggal yang diizinkan
                autoclose: true // Otomatis menutup datepicker setelah memilih tanggal
            });
        });
    </script>
</body>
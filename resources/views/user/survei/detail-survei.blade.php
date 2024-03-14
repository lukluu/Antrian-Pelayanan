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
                            <a href="/user/dashboard/survei-pengunjung" class="btn btn-danger btn-sm me-auto">Kembali</a>
                        </div>
                        <h3 class="text-center">Ambil Data Survei</h3>
                    </div>

                    <div class="card-body d-flex justify-content-center">
                        <form action="/user/dashboard/survei/hasil-survei/{{ $outlet_id }}" method="GET" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control datepicker " placeholder="Mulai" name="start_date" autocomplete="off">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control datepicker" placeholder="Akhir" name="end_date" autocomplete="off">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-sm">Filter Data</button>
                            </div>
                        </form>
                    </div>
                    @if($surveis->isNotEmpty())
                    <div class="row d-flex justify-content-center" id="cetak">
                        <div class="col-11">
                            <div class="card mb-4 rounded-0 border-2 border-r border-dark">
                                <div class="card-header pb-0">
                                    <h6 class="text-center">INDEX KEPUASAN MASYARAKAT (IKM)</h6>
                                    <h6 class="text-center">DINAS/KANTOR/UNIT/UPT {{ $instansi }}</h6>
                                    <h6 class="text-center">KOTA KENDARI</h6>
                                    <h6 class="text-center">BULAN/TRIWULAN/SEMESTER/......TAHUN {{$year}}</h6>
                                </div>
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="row py-3 px-5 d-flex justify-content-center">
                                        <div class="col-lg-6 col-md-6 col-12 border border-dark p-0">
                                            <div class="card-header p-0 m-0">
                                                <h6 class="text-center border border-dark text-bolder">Nilai IKM</h6>
                                            </div>
                                            <div class="card-body d-flex align-items-center justify-content-center" style="height: 50vh;">
                                                <h1 class="text-center" style="font-size: 5rem;">{{ $final_score }}</h1>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 border border-dark p-0">
                                            <div class="card-header p-0 m-0">
                                                <h6 class="text-center border border-dark "> Nama Layanan : {{ $nama_layanan }}</h6>
                                            </div>
                                            <div class="card-body py-1 px-3 d-flex flex-column">
                                                <h6 class="text-center text-dark text-bolder">Responden</h6>
                                                <table class="table mb-0 p-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="px-0"></th>
                                                            <th class="px-0"></th>
                                                            <th class="px-0"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-bolder text-sm">
                                                            <td>Total Pengunjung</td>
                                                            <td>:</td>
                                                            <td>{{ $total_visitors }} orang</td>
                                                        </tr>
                                                        <tr class="text-bolder text-sm">
                                                            <td>Jenis Kelamin</td>
                                                            <td>:</td>
                                                            <td>L = {{ $total_male }} / P = {{ $total_female }}</td>
                                                        </tr>
                                                        <tr class="text-bolder text-sm">
                                                            <td>Pendidikan</td>
                                                            <td>:</td>
                                                            <td class="d-flex flex-column">
                                                                @foreach (['SD', 'SMP', 'SMA', 'DIII', 'S1', 'S2', 'S3'] as $education)
                                                                <p class="text-bolder text-sm p-0 m-0">{{ $education }} = {{ $total_education[$education] ?? 0 }} orang</p>
                                                                @endforeach
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                                <small class="text-center text-bolder text-sm mt-3"> Periode survei : {{ $start_date }} s/d {{ $end_date }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center flex-column m-0 p-0 pb-2">
                                    <small class="text-center text-bolder">TERIMA KASIH PELAYANAN YANG TELAH ANDA BERIKAN </small>
                                    <small class="text-center text-bolder">MASUKAN ANDA SANGAT BERMANFAAT UNTUK KEMAJUAN UNIT KAMI AGAR TERUS MEMPERBAIKI </small>
                                    <small class="text-center text-bolder">DAN MENINGKATKAN KUALITAS PELAYANAN BAGI MASYARAKAT</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-5">
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <button class="btn btn-danger" id="cetakPdf" onclick="cetakPdf()">
                                <i class="bi bi-file-earmark-pdf"></i> Cetak PDF</button>
                            <a href="{{ route('survei.unduh.excel', ['id' => $outlet_id, 'start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    @if($surveis->isNotEmpty())
    <script>
        function cetakPdf() {
            var element = document.getElementById('cetak');
            element.style.marginTop = '100px';
            html2pdf().from(element).save('Hasil Survei Penilaian {{$nama_layanan}} {{$start_date}} s/d {{$end_date}}.pdf');
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
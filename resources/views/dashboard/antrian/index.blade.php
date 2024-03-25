@extends('layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<!-- JavaScript jQuery (diperlukan oleh Bootstrap-datepicker) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex flex-column">
                <div class="col-4">
                    <h3>Data Pengunjung</h3>
                </div>
                <div class="d-flex">
                    <form action="/dashboard/data-antrian/filter" method="GET" class="row g-3">
                        <div class="col-auto">
                            <input type="text" class="form-control datepicker " placeholder="Mulai" name="start_date" autocomplete="off">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control datepicker" placeholder="Akhir" name="end_date" autocomplete="off">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        </div>
                    </form>
                    <div class="ms-2">
                        <a href="/dashboard/data-antrian/cetak" type="button" class="btn btn-danger btn-sm">
                            <i class="bi bi-filetype-pdf"></i>
                            Cetak
                        </a>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-left">Layanan</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">Tanggal Antrian</th>
                                        <th class="text-left">Terlayani</th>
                                        <th class="text-left">Isi Survei</th>
                                        <th class="text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($antrians as $antrian)
                                    <tr>
                                        <td class="text-left">{{ $loop->iteration }}</td>
                                        <td class="text-left layanan">{{ $antrian->outlet->nama_layanan }}</td>
                                        <td class="text-left">{{ $antrian->nama }}</td>
                                        <td class="text-left">{{ $antrian->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @if( $antrian['status'] == 1 )
                                            <small class="text-bolder text-success">Terlayani</small>
                                            @else
                                            <small class="text-bolder text-danger">Belum</small>
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            @if( $antrian['survei'] == 1 )
                                            <small class="text-bolder text-success">Sudah</small>
                                            @else
                                            <small class="text-bolder text-danger">Belum</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/dashboard/antrian/detail/{{ $antrian->id }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye-fill"></i>
                                                Detail
                                            </a>
                                        </td>
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
<script>
    // Ambil semua sel dengan kelas "layanan" dalam tabel
    var cells = document.querySelectorAll('table#table1 td.layanan');

    // Loop melalui setiap sel "Layanan"
    cells.forEach(function(cell) {
        // Ambil teks dari sel
        var text = cell.textContent.trim();

        // Batasi jumlah kata menjadi 5
        var maxWords = 3;
        var words = text.split(/\s+/); // Pecah teks menjadi kata-kata
        var truncatedText = words.slice(0, maxWords).join(' '); // Ambil sebagian kata sesuai dengan batas maksimum

        // Tambahkan elipsis jika teks dipotong
        if (words.length > maxWords) {
            truncatedText += '...';
        }

        // Tampilkan teks yang telah dipotong di sel
        cell.textContent = truncatedText;
    });
</script>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Format tanggal yang diizinkan
            autoclose: true // Otomatis menutup datepicker setelah memilih tanggal
        });
    });
</script>
@endsection
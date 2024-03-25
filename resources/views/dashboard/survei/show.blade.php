@extends('layouts.main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="back m-2 mb-0">
                    <a href="/dashboard/data-survei" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
                <h3 class="text-center">Hasil</h3>
            </div>

            <div class="card-body ">
                <div class="row d-flex justify-content-center text-black" id="cetak">
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
                                        <div class="card-header p-0 m-0  border border-dark rounded-0 text-center">
                                            <small class="text-center"> Nama Layanan : {{ $nama_layanan }}</small>
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
                                            @if($start_date && $end_date)
                                            <small class="text-center text-bolder text-sm mt-3"> Periode survei : {{ $start_date }} s/d {{ $end_date }}</small>
                                            @else
                                            <small class="text-center text-bolder text-sm mt-3"> Periode survei : {{ $lama }} s/d {{ $baru }}</small>
                                            @endif

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
                            <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
                        </button>
                        @if($start_date && $end_date)
                        <a href="{{ route('survei.unduh.excel', ['id' => $outlet_id, 'start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>
                        @else
                        <a href="{{ route('survei.unduh.excel', ['id' => $outlet_id, 'lama' => $lama, 'baru' => $baru]) }}" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
@if($start_date && $end_date)
<script>
    function cetakPdf() {
        var element = document.getElementById('cetak');
        element.style.marginTop = '100px';
        html2pdf().from(element).save('Hasil Survei Penilaian {{$nama_layanan}} {{$start_date}} s/d {{$end_date}}.pdf');
    }
</script>
@else
<script>
    function cetakPdf() {
        var element = document.getElementById('cetak');
        element.style.marginTop = '100px';
        html2pdf().from(element).save('Hasil Survei Penilaian {{$nama_layanan}} {{$lama}} s/d {{$baru}}.pdf');
    }
</script>
@endif
@endsection
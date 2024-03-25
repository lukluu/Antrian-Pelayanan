@extends('layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert2.min.js') }}"></script>
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="back m-2 mb-0">
                    <a href="/dashboard" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
                <h3 class="text-center">Cek Survei Layanan</h3>
            </div>

            <div class="card-body ">
                <form action="/dashboard/data-survei/show" method="GET" class="col-12">
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
                        <div class="col-3">
                            <label for="instansi">Instansi</label>
                            <select class="form-select @error('instansi')is-invalid @enderror" id="instansi" name="instansi">
                                <option value="">Pilih Instansi</option>
                            </select>
                            @error('instansi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <label for="layanan">Layanan</label>
                            <select class="form-select @error('nama_layanan')is-invalid @enderror" id="layanan" name="nama_layanan">
                                <option value="">Pilih Layanan</option>
                            </select>
                            @error('nama_layanan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm">fiter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(session('info'))
<script>
    Swal.fire({
        text: "{{ session()->get('info') }}",
        icon: "info",
        confirmButtonText: "OK",
    });
</script>
@endif
<!-- JavaScript jQuery (diperlukan oleh Bootstrap-datepicker) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        // Fungsi untuk mendapatkan data instansi dari server
        function getInstansiData() {
            $.ajax({
                url: "{{ route('dashboard.data-survei.instansi') }}",
                success: function(data) {
                    // Perbarui dropdown instansi dengan data yang diterima
                    $('#instansi').empty();
                    $('#instansi').append('<option value="">Pilih Instansi</option>');
                    $.each(data, function(key, value) {
                        $('#instansi').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }

        // Panggil fungsi untuk mendapatkan data instansi saat halaman dimuat
        getInstansiData();

        // Tambahkan event listener untuk perubahan pada dropdown instansi
        $('#instansi').change(function() {
            var instansiId = $(this).val();
            if (instansiId !== '') {
                $.ajax({
                    url: "{{ url('dashboard/data-survei/layanan') }}/" + instansiId,
                    success: function(data) {
                        $('#layanan').empty();
                        $('#layanan').append('<option value="">Pilih Layanan</option>');
                        $.each(data, function(key, value) {
                            $('#layanan').append('<option value="' + value.id + '">' + value.nama_layanan + '</option>');
                        });
                    }
                });
            } else {
                $('#layanan').empty();
                $('#layanan').append('<option value="">Pilih Layanan</option>');
            }
        });
    });
</script>

@endsection
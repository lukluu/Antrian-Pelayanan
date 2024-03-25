@include('layouts.head')

<style>
    .active .aha {
        background-color: #715EE5 !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        color: white;
        border: white 1px solid;
    }

    .card {
        display: flex;
        flex-direction: column;
        height: 100%;

        /* Ensure the card takes full height of its parent */
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* Menengahkan konten secara vertikal */

        /* Menengahkan konten secara horizontal */
    }

    .card-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        /* Menengahkan kartu secara horizontal */
    }

    /* Ensure all cards within a row stretch to the height of the tallest card */
    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .row>.col-xl-3 {
        display: flex;
    }

    .row .card {
        flex: 1;
    }

    .no-border-radius {
        border-radius: 5px !important;
        /* Remove border radius */
    }

    @media (max-width: 576px) {
        #title {
            font-size: 1rem;
            /* Atur ukuran font menjadi 1.25rem untuk perangkat berukuran hp */
        }
    }

    .bgdiv {
        background-image: url('{{ asset("img/bg/bg.svg") }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        width: 100%;
        position: relative;
        padding: 0;
        margin: 0;
    }
</style>

<body class="bgdiv">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto">
                    <a class="nav-link text-white" href="/">Home</a>
                </div>
            </div>
        </div>
        <div class="album py-5 bg-body-tertiary">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('layar.instansi', ['instansiId' => $instansiSebelumnya ? $instansiSebelumnya->id : $instansi->id, 'action' => 'sebelumnya']) }}" class="btn btn-white">
                        <i class="bi bi-caret-left-fill"></i>
                    </a>
                </div>
                <div class="col-auto">
                    <!-- Tautan untuk instansi berikutnya -->
                    <a href="{{ route('layar.instansi', ['instansiId' => $instansiBerikutnya ? $instansiBerikutnya->id : $instansi->id, 'action' => 'berikutnya']) }}" class="btn btn-white">
                        <i class="bi bi-caret-right-fill"></i>
                    </a>
                </div>
            </div>
            <h1 class="text-white bg blur bg-gradient-primary text-center py-3">{{ $title }}</h1>
            <div class="container-fluid mt-5">
                <div class="row d-flex justify-content-center">
                    @foreach ($outlets as $outlet)
                    @if ($antriansByOutlet[$outlet->id])
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header bg-primary ">
                                <h4 class="text-center text-white">{{ $outlet->nama_layanan }}</h4>
                            </div>
                            <div class="card-body">

                                <h1 class="card-title text-bold display-1">{{ $antriansByOutlet[$outlet->id]->no_antri }}</h1>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

        </div>

    </main>

    <script>
        setInterval(function() {
            location.reload();
        }, 5000); // Reload halaman setiap 1 detik (1000 milidetik)
    </script>
</body>
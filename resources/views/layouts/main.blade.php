@include('layouts.head')
<style>
    .dropdown-menu {
        border: none;
        background-color: #f8f9fa;
        /* Warna latar belakang */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* Bayangan */
    }

    .dropdown-item {
        color: #212529;
        /* Warna teks */
    }

    .dropdown-item:hover {
        background-color: #e9ecef;
        /* Warna latar belakang saat dihover */
    }

    .text-danger {
        color: #dc3545 !important;
        /* Warna teks merah untuk logout */
    }

    .nav-item.dropdown {
        position: relative;
        /* Mengatur posisi relatif */
    }

    .nav-item.dropdown .dropdown-menu {
        margin-top: 0 !important;
        /* Menghilangkan margin top */
    }
</style>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        @include('layouts.sidebar')
    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('layouts.nav')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('container')
        </div>
    </main>
    @include('layouts.scripts')

</body>

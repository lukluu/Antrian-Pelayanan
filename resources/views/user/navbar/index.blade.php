<style>
    .navbar-nav a.nav-link.active {
        background-color: #6c757d;
        /* Warna latar belakang sekunder untuk navigasi aktif dari tema Bootstrap */
        color: #fff;
        /* Warna teks untuk navigasi aktif */
        font-weight: bold;
        /* Style teks untuk navigasi aktif */
        border-radius: 10px;
        padding: 0.5em 1em;

    }
</style>

<div class="col-12">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
        <div class="container-fluid">
            <div class="navbar-brand font-weight-bolder text-black ms-lg-0 ms-3 ">
                STAF {{ $instansi }}
            </div>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center me-2 {{ Request::is('user/dashboard') || Request::is('user/dashboard/detail*') ? 'active' : '' }}" aria-current="page" href="/user/dashboard">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 {{ Request::is('user/dashboard/terlayani*') ? 'active' : '' }}" href="/user/dashboard/terlayani">
                            Daftar Pengunjung Terlayani
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 {{ Request::is('user/dashboard/survei-pengunjung*') ? 'active' : '' }}" href="/user/dashboard/survei-pengunjung">
                            Survei Pengunjung
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 {{ Request::is('user/dashboard/syarat-layanan*') ? 'active' : '' }}" href="/user/dashboard/syarat-layanan">
                            Kelola Syarat Layanan
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-lg-block align-content-center">
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="profile-icon"></span>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/user/dashboard/setting">Settings</a></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container  custom-margin">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">{{ strtoupper(auth()->user()->role) }}</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ strtoupper(auth()->user()->username) }}</li>
            </ol>
        </nav>
    </div>
    <!-- End Navbar -->
</div>
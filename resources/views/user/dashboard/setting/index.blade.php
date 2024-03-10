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

    .container-fluid {
        width: 100%;
        max-width: 1200px;
        /* Atur lebar maksimum sesuai kebutuhan */
        margin-left: auto;
        margin-right: auto;
    }

    .center-horizontal {
        display: grid;
        place-items: center;
        height: 100vh;
        /* Menempatkan kontainer di tengah halaman vertikal */
        /* Menambahkan gaya tambahan jika diperlukan */
    }
</style>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert2.min.js') }}"></script>

<body class="bg-gray-100">
    <div class="min-height-400 bg-primary opacity-10 position-absolute w-100"></div>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
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
                                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="/user/dashboard">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="/user/dashboard/terlayani">
                                        Daftar Pengunjung Terlayani
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="/user/dashboard/survei-pengunjung">
                                        Survei Pengunjung
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
            </div>
            <div class="container-fluid center-horizontal mt-5 col-12">
                <div class="row">
                    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                        <div class="card shadow-lg mb-2">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <div class="d-flex align-items-center">
                                                    <a href="/user/dashboard" class="mb-0 badge bg-danger font-extrabold text-lowercase">
                                                        <i class="bi bi-arrow-left"></i>Kembali</a>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ route('user.dashboard.setting', $id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name" class="form-control-label">Nama Lengkap</label>
                                                                <input value="{{ old('name', $name)}}" class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name">
                                                                @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="username" class="form-control-label">Username</label>
                                                                <input value="{{ old('username', $username) }}" class="form-control @error('username') is-invalid @enderror" type="text" id="username" name="username">
                                                                @error('username')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-password-input" class="form-control-label">Password</label>
                                                                <div class="input-group">
                                                                    <input class="form-control @error('password')is-invalid @enderror" type="password" id="example-password-input" name="password">
                                                                    <button class="badge bg-primary border-none" type="button" id="togglePassword">
                                                                        <i type="button" class="fa fa-eye"></i>
                                                                    </button>
                                                                    @error('password')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="horizontal dark">
                                                    </div>
                                                    <div class="card-header pb-0">
                                                        <div class="d-flex align-items-center">
                                                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.scripts')
        @include('sweetalert::alert')
        <script>
            document.getElementById('togglePassword').addEventListener('click', function() {
                var passwordInput = document.getElementById('example-password-input');
                var passwordIcon = document.querySelector('#togglePassword i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                }
            });
        </script>
</body>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 row" id="navbar">
            <ul class="navbar-nav d-flex">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center col-auto me-4">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <nav aria-label="breadcrumb" class="col-auto">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">{{ strtoupper(auth()->user()->role) }}</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ strtoupper(auth()->user()->username) }}</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
                </nav>
                <li class="nav-item dropdown col-auto ms-auto">
                    <div class="nav-link dropdown-toggle text-white font-weight-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, {{ strtoupper(auth()->user()->name) }}!
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end mt-0" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/dashboard/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="/">Ke Home</a></li>
                        <form action="/logout" method="post" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">LogOut</button>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</nav>

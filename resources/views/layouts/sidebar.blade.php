<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" target="_blank">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Antrian Pelayanan</span>
    </a>
</div>
<hr class="horizontal dark mt-0">
<div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/data-antrian') ? 'active' : '' }}" href="/dashboard/data-antrian">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Data Pengunjung</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/data-instansi*') ? 'active' : '' }}" href="/dashboard/data-instansi">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Data Layanan Instansi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/data-user*') ? 'active' : '' }}" href="/dashboard/data-user">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Data Staff Gerai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/survei*') ? 'active' : '' }}" href="/dashboard/data-survei">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-bullet-list-67 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Survei</span>
            </a>
        </li>
    </ul>
</div>
<div class="sidenav-footer mx-3 mt-1">
    <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="/assets/img/kota.png" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
            <div class="docs-info">
                <h6 class="mb-0">Pelayanan Bermutu</h6>
                <p class="text-xs font-weight-bold mb-0">Balai Kota Kendari</p>
            </div>
        </div>
    </div>
    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="btn btn-outline-secondary btn-sm w-100 mb-3">LogOut</button>
    </form>
</div>

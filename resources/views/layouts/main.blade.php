@include('layouts.head')

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

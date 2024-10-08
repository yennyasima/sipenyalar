<style>
    .nav-link.active {
        color: #D95639 !important;
    }

    .nav-link:hover {
        color: #D95639 !important;
    }
</style>

<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        {{-- <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form> --}}
        <ul class="navbar-nav">
            <li class="nav-item mx-3">
                <a class="nav-link" href="/">
                    {{-- <i data-feather="home"></i> --}}
                    <span>HOME</span>
                </a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link active" href="/peta">
                    {{-- <i data-feather="map"></i> --}}
                    <span>PETA</span>
                </a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link" href="/grafik">
                    {{-- <i data-feather="bar-chart-2"></i> --}}
                    <span>GRAFIK</span>
                </a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link" href="/artikel">
                    {{-- <i data-feather="book"></i> --}}
                    <span>ARTIKEL</span>
                </a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link" href="/login">
                    {{-- <i data-feather="book"></i> --}}
                    <span>LOGIN</span>
                </a>
            </li>
        </ul>

    </div>
</nav>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Warna untuk teks dan icon aktif */
        .nav-link.active,
        .nav-link.active i,
        .nav-item.active>a .link-title,
        .nav-item.active>a i {
            color: #FDE8E3 !important;
        }

        /* Aturan untuk ikon di dalam sub-menu */
        .nav-item.active>a .link-icon {
            color: #FDE8E3 !important;
        }

        /* Menangani warna saat hover jika diperlukan */
        .nav-link:hover {
            color: #FDE8E3 !important;
        }

        .sidebar {
            padding: 10px !important;
            width: 250px !important;
        }

        .sidebar-header {
            padding: 10px !important;
            background-color: #D95639 !important;
            border-radius: 15px !important;
            width: 231px !important;
            display: flex !important;
            justify-content: flex-start !important;
            justify-items: start !important;

        }

        .sidebar-body {
            background-color: #D95639 !important;
            border-radius: 15px !important;
        }
    </style>
</head>

<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="/" class="logo">
                <h3 style="font-weight: bold; color:#FDE8E3">SIPENAYALAR</h3>
            </a>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Halaman</li>
                <li
                    class="nav-item {{ request()->routeIs('admin.data-penyakit-dbd.*', 'admin.faskes-pdp-hiv.*', 'admin.wilayah-rentan-hiv.*', 'admin.tuna-susila-hiv.*', 'admin.penduduk-pria-usi-produktiv-hiv.*', 'admin.penduduk-miskin-hiv.*', 'admin.lokasi-rawan-tuna-susila-hiv.*', 'admin.hostpot-hiv.*', 'admin.kasus-hiv.*', 'admin.news.*', 'admin.data-penyakit-dbd.*', 'admin.user*', 'admin.kepadatan-penduduk-dbd.*', 'admin.faktor-lingkungan-dbd.*', 'admin.data-penyakit-ispa.*', 'admin.kepadatan-penduduk-ispa.*', 'admin.curah-hujan-ispa.*', 'admin.kelembapan-ispa.*', 'admin.suhu-ispa.*') ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#home" role="button" aria-expanded="false"
                        aria-controls="emails">
                        <i class="link-icon" data-feather="grid"></i>
                        <span class="link-title">Self Maintenance</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.news.*', 'admin.faskes-pdp-hiv.*', 'admin.wilayah-rentan-hiv.*', 'admin.tuna-susila-hiv.*', 'admin.penduduk-pria-usi-produktiv-hiv.*', 'admin.penduduk-miskin-hiv.*', 'admin.lokasi-rawan-tuna-susila-hiv.*', 'admin.hostpot-hiv.*', 'admin.kasus-hiv.*', 'admin.data-penyakit-dbd.*', 'admin.user*', 'admin.kepadatan-penduduk-dbd.*', 'admin.faktor-lingkungan-dbd.*', 'admin.data-penyakit-ispa.*', 'admin.kepadatan-penduduk-ispa.*', 'admin.curah-hujan-ispa.*', 'admin.kelembapan-ispa.*', 'admin.suhu-ispa.*') ? 'show' : '' }}"
                        id="home">
                        <ul class="nav sub-menu">
                            <!-- News -->
                            <li class="nav-item">
                                <a href="{{ route('admin.news.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">Artikel</a>
                            </li>

                            <!-- DBD Submenu -->
                            <li
                                class="nav-item  {{ request()->routeIs('admin.data-penyakit-dbd.*', 'admin.kepadatan-penduduk-dbd.*', 'admin.faktor-lingkungan-dbd.*') ? 'active' : '' }}">
                                <a class="nav-link " data-bs-toggle="collapse" href="#dbd" role="button"
                                    aria-expanded="false" aria-controls="dbd">
                                    <span class="link-title">DBD</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.data-penyakit-dbd.*', 'admin.kepadatan-penduduk-dbd.*', 'admin.faktor-lingkungan-dbd.*') ? 'show' : '' }}"
                                    id="dbd">
                                    <ul class="nav sub-menu">
                                        <!-- data penyakit DBD -->
                                        <li class="nav-item">
                                            <a href="{{ route('admin.data-penyakit-dbd.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.data-penyakit-dbd.*') ? 'active' : '' }}">data
                                                penyakit</a>
                                        </li>

                                        <!-- Grafik -->
                                        <li class="nav-item">
                                            <a href="{{ route('admin.kepadatan-penduduk-dbd.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.kepadatan-penduduk-dbd.*') ? 'active' : '' }}">
                                                Kepadatan Penduduk
                                            </a>
                                        </li>

                                        <!-- Data -->
                                        <li class="nav-item">
                                            <a href="{{ route('admin.faktor-lingkungan-dbd.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.faktor-lingkungan-dbd.*') ? 'active' : '' }}">Faktor
                                                lingkungan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ISPA Submenu -->
                            <li
                                class="nav-item {{ request()->routeIs('admin.data-penyakit-ispa.*', 'admin.kepadatan-penduduk-ispa.*', 'admin.curah-hujan-ispa.*', 'admin.kelembapan-ispa.*', 'admin.suhu-ispa.*') ? 'active' : '' }}">
                                <a class="nav-link" data-bs-toggle="collapse" href="#ispa" role="button"
                                    aria-expanded="false" aria-controls="ispa">
                                    <span class="link-title">ISPA</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.data-penyakit-ispa.*', 'admin.kepadatan-penduduk-ispa.*', 'admin.curah-hujan-ispa.*', 'admin.kelembapan-ispa.*', 'admin.suhu-ispa.*') ? 'show' : '' }}"
                                    id="ispa">
                                    <ul class="nav sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.data-penyakit-ispa.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.data-penyakit-ispa.*') ? 'active' : '' }}">data
                                                penyakit ISPA</a>
                                        </li>

                                        <!-- Grafik -->
                                        <li class="nav-item">
                                            <a href="{{ route('admin.kepadatan-penduduk-ispa.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.kepadatan-penduduk-ispa.*') ? 'active' : '' }}">
                                                Kepadatan Penduduk
                                            </a>
                                        </li>

                                        <!-- Data -->
                                        <li class="nav-item">
                                            <a href="{{ route('admin.curah-hujan-ispa.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.curah-hujan-ispa.*') ? 'active' : '' }}">
                                                Curah
                                                Hujan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.kelembapan-ispa.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.kelembapan-ispa.*') ? 'active' : '' }}">
                                                Kelembapan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.suhu-ispa.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.suhu-ispa.*') ? 'active' : '' }}">
                                                Suhu
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- HIV Submenu -->
                            <li
                                class="nav-item {{ request()->routeIs('admin.kasus-hiv.*', 'admin.faskes-pdp-hiv.*', 'admin.wilayah-rentan-hiv.*', 'admin.tuna-susila-hiv.*', 'admin.penduduk-pria-usi-produktiv-hiv.*', 'admin.penduduk-miskin-hiv.*', 'admin.hostpot-hiv.*', 'admin.lokasi-rawan-tuna-susila-hiv.*') ? 'active' : '' }}">
                                <a class="nav-link" data-bs-toggle="collapse" href="#hiv" role="button"
                                    aria-expanded="false" aria-controls="hiv">
                                    <span class="link-title">HIV</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.kasus-hiv.*', 'admin.faskes-pdp-hiv.*', 'admin.wilayah-rentan-hiv.*', 'admin.tuna-susila-hiv.*', 'admin.penduduk-pria-usi-produktiv-hiv.*', 'admin.penduduk-miskin-hiv.*', 'admin.hostpot-hiv.*', 'admin.lokasi-rawan-tuna-susila-hiv.*') ? 'show' : '' }}"
                                    id="hiv">
                                    <ul class="nav sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.kasus-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.kasus-hiv.*') ? 'active' : '' }}">
                                                Kasus HIV
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.hostpot-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.hostpot-hiv.*') ? 'active' : '' }}">
                                                Hotspot HIV</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.lokasi-rawan-tuna-susila-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.lokasi-rawan-tuna-susila-hiv.*') ? 'active' : '' }}">
                                                Lok Rawan Tuna Susila</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.penduduk-miskin-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.penduduk-miskin-hiv.*') ? 'active' : '' }}">
                                                Penduduk Miskin
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="{{ route('admin.penduduk-pria-usi-produktiv-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.penduduk-pria-usi-produktiv-hiv.*') ? 'active' : '' }}">pria
                                                usia
                                                produktif</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.tuna-susila-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.tuna-susila-hiv.*') ? 'active' : '' }}">Tuna
                                                Susila</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.wilayah-rentan-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.wilayah-rentan-hiv.*') ? 'active' : '' }}">Wilayah
                                                Rentan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.faskes-pdp-hiv.index') }}"
                                                class="nav-link {{ request()->routeIs('admin.faskes-pdp-hiv.*') ? 'active' : '' }}">Faskes
                                                PDP HIV</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>



                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Feather Icons Initialization -->
    <script>
        feather.replace();
    </script>
</body>

</html>

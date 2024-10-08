<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Document</title> --}}
    <style>
        .sidebar-brand {
            color: #D95639 !important;
        }

        .sidebar-body {
            margin: 20px !important;
            background-color: #D95639 !important;
            border-radius: 15px !important;
            max-height: 80vh;
            /* Set a maximum height for the sidebar body */
            overflow-y: scroll;
            /* Enable vertical scrolling without scrollbar */
        }

        .sidebar-body::-webkit-scrollbar {
            width: 0;
            /* Hide scrollbar for Chrome, Safari, and Opera */
        }

        .sidebar-body {
            -ms-overflow-style: none;
            /* Hide scrollbar for Internet Explorer and Edge */
            scrollbar-width: none;
            /* Hide scrollbar for Firefox */
        }

        .sidebar .sidebar-header {
            width: 340px !important;
            border-right: none !important;
        }

        .tombol-cari {
            width: 100% !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 5px !important;
        }

        .legenda-icon {
            /* width: 12px;
            height: 12px; */
            margin-right: 5px;
        }
    </style>


</head>

<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-brand">
                SIPENYALAR
            </a>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false"
                        aria-controls="filters">
                        <i class="link-icon text-white" data-feather="filter"></i>
                        <span class="link-title text-white">Filter</span>
                        <i class="link-arrow text-white" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="filters">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <div class="mb-3">
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1">
                                        <option selected disabled>Pilih Tahun</option>
                                        <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>
                                            Januari
                                        </option>
                                        <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>
                                            Februari
                                        </option>
                                        <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret
                                        </option>
                                        <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April
                                        </option>
                                        <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei
                                        </option>
                                        <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni
                                        </option>
                                        <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli
                                        </option>
                                        <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>
                                            Agustus
                                        </option>
                                        <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>
                                            September
                                        </option>
                                        <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>
                                            Oktober
                                        </option>
                                        <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>
                                            November
                                        </option>
                                        <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="mb-3">
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1">
                                        <option selected disabled>Pilih Bulan</option>
                                        <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>
                                            Januari
                                        </option>
                                        <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>
                                            Februari
                                        </option>
                                        <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret
                                        </option>
                                        <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April
                                        </option>
                                        <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei
                                        </option>
                                        <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni
                                        </option>
                                        <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli
                                        </option>
                                        <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>
                                            Agustus
                                        </option>
                                        <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>
                                            September
                                        </option>
                                        <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>
                                            Oktober
                                        </option>
                                        <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>
                                            November
                                        </option>
                                        <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="mb-3">
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1">
                                        <option selected disabled>Pilih Penyakit</option>
                                        <option>12-18</option>
                                        <option>18-22</option>
                                        <option>22-30</option>
                                        <option>30-60</option>
                                        <option>Above 60</option>
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="mb-3">
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1">
                                        <option selected disabled>Pilih Wilayah</option>
                                        <option>12-18</option>
                                        <option>18-22</option>
                                        <option>22-30</option>
                                        <option>30-60</option>
                                        <option>Above 60</option>
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <button class="tombol-cari">Cari</button>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#legenda" role="button" aria-expanded="false"
                        aria-controls="legenda">
                        <i class="link-icon text-white" data-feather="map"></i>
                        <span class="link-title text-white">Legenda</span>
                        <i class="link-arrow text-white" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="legenda">
                        <ul class="nav sub-menu">
                            <li class="nav-item text-white">
                                <div>
                                    <p><i class="bi bi-square-fill legenda-icon text-primary"></i><span>DBD</span></p>
                                    <p><i class="bi bi-square-fill legenda-icon text-warning"></i></i><span>HIV</span>
                                    </p>
                                    <p></i><i class="bi bi-square-fill legenda-icon text-info"></i><span>ISPA</span></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#deskripsi" role="button" aria-expanded="false"
                        aria-controls="deskripsi">
                        <i class="link-icon text-white" data-feather="book-open"></i>
                        <span class="link-title text-white">Deskripsi Peta</span>
                        <i class="link-arrow text-white" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="deskripsi">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <p class="text-white">[ Data Peta Tidak Ditemukan ]</p>
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

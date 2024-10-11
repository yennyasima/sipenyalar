<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="SIPENYALAR">
    <meta name="author" content="SIPENYALAR">

    <title>SIPENYALAR - PETA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">

    <!-- Inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style2.css') }}">

    <!-- CKEditor 5 -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.css" />

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Leaflet Maps CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.css">

    <!-- OpenLayers -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box !important;
        }

        .main-wrapper .page-wrapper {
            width: 100% !important;
            margin-left: 0 !important;
        }

        .sidebar-brand {
            color: #D95639 !important;
        }

        .sidebar-body {
            margin: 20px !important;
            background-color: #D95639 !important;
            border-radius: 15px !important;
            max-height: 80vh;
            overflow-y: scroll;
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

        .nav-link.active {
            color: #D95639 !important;
        }

        .nav-link:hover {
            color: #D95639 !important;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .page-content {
            padding: 0 !important;
            margin: 0;
        }

        .ol-control {
            right: auto !important;
            top: auto !important;
            left: 340px !important;
        }


        .ol-zoom {
            top: 70px !important;
            display: flex;
            flex-direction: column;
            background-color: transparent !important;
        }

        .ol-zoom .ol-zoom-in {
            margin-bottom: 10px;
        }

        .ol-full-screen {
            top: 30px !important;
        }

        .ol-scale-line {
            right: 10px !important;
            top: auto !important;
            left: auto !important;
        }

        .ol-control button {
            background-color: #D95639 !important;
            color: white !important;
            border: none !important;
            border-radius: 5px !important;
            font-size: 20px !important;
        }

        .ol-control button:active {
            background-color: #B2452B !important;
        }

        .ol-mouse-position {
            position: absolute;
            top: 470px !important;
            bottom: auto !important;
            right: 400px !important;
            left: auto;
            background-color: rgba(210, 209, 209, 0.806);
            /* Latar belakang transparan */
            color: black !important;
            /* Warna teks putih */
            padding: 10px 20px !important;
            border-radius: 10px;
            font-size: 12px;
            z-index: 1000;
        }

        .screenshot-button {
            position: fixed;
            top: 80px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #D95639;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            /* Agar selalu di depan */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .screenshot-button:hover {
            background-color: #B2452B;
            /* Warna saat hover */
        }

        .screenshot-button i {
            font-size: 24px;
            /* Ukuran ikon */
        }

        .map-theme-selector {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
        }

        .map-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            color: #D95639;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 5px;
        }

        .map-option-content {
            display: flex;
            flex-direction: row;
            gap: 10xp;
        }

        .map-option img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .map-option label {
            display: flex;
            align-items: center;
            padding: 10px;
            width: 100%;
            color: white;
            font-size: 14px;
        }

        .map-option input[type="radio"] {
            margin-right: 10px;
            accent-color: #D95639;
        }

        .map-option input[type="radio"]:checked+label {
            background-color: #f4f4f4af;
        }
    </style>

    @yield('css')

</head>

<body>
    <div class="main-wrapper">
        {{-- SIDEBAR --}}
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('home') }}" class="sidebar-brand">
                    SIPENYALAR
                </a>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#filters" role="button"
                            aria-expanded="false" aria-controls="filters">
                            <i class="link-icon text-white" data-feather="filter"></i>
                            <span class="link-title text-white">Filter</span>
                            <i class="link-arrow text-white" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="filters">
                            <form id="filter-form">
                                <ul class="nav sub-menu">
                                    <li class="nav-item">
                                        <div class="mb-3">
                                            <select class="form-select form-select-sm" id="tahun" name="tahun">
                                                <option selected disabled>Pilih Tahun</option>
                                                <!-- Loop for years -->
                                                @for ($year = date('Y'); $year >= 2000; $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="mb-3">
                                            <select class="form-select form-select-sm" id="bulan" name="bulan">
                                                <option selected disabled>Pilih Bulan</option>
                                                @foreach (range(1, 12) as $month)
                                                    <option value="{{ $month }}">
                                                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="mb-3">
                                            <select class="form-select form-select-sm" id="jenisPenyakit"
                                                name="jenisPenyakit">
                                                <option selected disabled>Pilih Jenis Penyakit</option>
                                                <option value="DBD">DBD</option>
                                                <option value="ISPA">ISPA</option>
                                                <option value="HIV">HIV</option>
                                            </select>
                                        </div>
                                    </li>

                                    <li class="nav-item">
                                        <div class="col-md-12">
                                            <button type="button" class="tombol-cari"
                                                id="submit-filter">Cari</button>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#transparansi" role="button"
                            aria-expanded="false" aria-controls="transparansi">
                            <i class="link-icon text-white" data-feather="sliders"></i>
                            <span class="link-title text-white">Transparansi</span>
                            <i class="link-arrow text-white" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="transparansi">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <p class="text-white">[ data tidak ditemukan ]</p>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#legenda" role="button"
                            aria-expanded="false" aria-controls="legenda">
                            <i class="link-icon text-white" data-feather="flag"></i>
                            <span class="link-title text-white">Legenda</span>
                            <i class="link-arrow text-white" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="legenda">
                            <ul class="nav sub-menu">
                                <li class="nav-item text-white">
                                    <div>
                                        <p><i class="bi bi-square-fill legenda-icon text-primary"></i><span>DBD</span>
                                        </p>
                                        <p><i
                                                class="bi bi-square-fill legenda-icon text-warning"></i></i><span>HIV</span>
                                        </p>
                                        <p></i><i
                                                class="bi bi-square-fill legenda-icon text-info"></i><span>ISPA</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#basemap" role="button" aria-expanded="false"
                            aria-controls="basemap">
                            <i class="link-icon text-white" data-feather="map"></i>
                            <span class="link-title text-white">Basemap</span>
                            <i class="link-arrow text-white" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="basemap">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <div class="map-theme-selector">

                                        <!-- World Imagery Map -->
                                        <div class="map-option">
                                            <label for="imagery">
                                                <img src="{{ asset('./assets/images/map1.png') }}" alt="World Imagery Map">
                                            </label>
                                            <div class="map-option-content">
                                                <input type="radio" id="imagery" name="map-theme" value="imagery" onclick="switchMapTheme(this.value)">
                                                <p>World Imagery Map</p>
                                            </div>
                                        </div>

                                        <!-- World Street Map -->
                                        <div class="map-option">
                                            <label for="street">
                                                <img src="{{ asset('./assets/images/map2.png') }}" alt="World Street Map">
                                            </label>
                                            <div class="map-option-content">
                                                <input type="radio" id="street" name="map-theme" value="street" onclick="switchMapTheme(this.value)">
                                                <p>World Street Map</p>
                                            </div>
                                        </div>

                                        <!-- Open Street Map -->
                                        <div class="map-option">
                                            <label for="osm">
                                                <img src="{{ asset('./assets/images/map3.png') }}" alt="Open Street Map">
                                            </label>
                                            <div class="map-option-content">
                                                <input type="radio" id="osm" name="map-theme" value="osm" onclick="switchMapTheme(this.value)">
                                                <p>Open Street Map</p>
                                            </div>
                                        </div>

                                        <!-- Esri World Map -->
                                        <div class="map-option">
                                            <label for="esri">
                                                <img src="{{ asset('./assets/images/map4.png') }}" alt="Esri World Map">
                                            </label>
                                            <div class="map-option-content">
                                                <input type="radio" id="esri" name="map-theme" value="esri" onclick="switchMapTheme(this.value)" checked>
                                                <p>Esri World Map</p>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#deskripsi" role="button"
                            aria-expanded="false" aria-controls="deskripsi">
                            <i class="link-icon text-white" data-feather="book-open"></i>
                            <span class="link-title text-white">Deskripsi Peta</span>
                            <i class="link-arrow text-white" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="deskripsi">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <p id="deskripsi-wilayah" class="text-white">[ Data Peta Tidak Ditemukan ]</p>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- <!-- Sidebar -->
        @include('components.peta.sidebar') --}}

        {{-- HEADER --}}
        <div class="page-wrapper">

            <!-- Navbar -->
            @include('components.peta.header')

            {{-- CONTENT --}}
            <div class="page-content">
                <div id="map"></div>

                <button id="screenshot-btn" class="screenshot-button">
                    <i class="bi bi-camera"></i>
                </button>

            </div>


            <!-- Main Content -->
            {{-- @yield('content') --}}

            <!-- Footer -->
            {{-- @include('components.admin.footer') --}}

        </div>
    </div>

    <!-- jQuery harus di-load terlebih dahulu -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap Bundle JS (includes Popper.js for dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Feather Icons Initialization -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script>
        feather.replace();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard-light.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>

    <!-- Leaflet (peta) JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.js"></script>

    <!-- OpenLayers -->
    <script src="https://cdn.jsdelivr.net/npm/ol@v10.2.1/dist/ol.js"></script>
    <script>
        // Inisialisasi peta menggunakan OpenLayers
        var osmLayer = new ol.layer.Tile({
            source: new ol.source.OSM()
        });

        var vectorSource = new ol.source.Vector({
            features: []
        });

        var vectorLayer = new ol.layer.Vector({
            source: vectorSource,
            style: new ol.style.Style({
                fill: new ol.style.Fill({
                    color: '#ffffff'
                }),
                stroke: new ol.style.Stroke({
                    color: '#ffffff',
                    width: 2
                })
            })
        });

        var view = new ol.View({
            center: ol.proj.fromLonLat([110.37080987401741, -7.801522645533201]),
            zoom: 13
        });

        var map = new ol.Map({
            target: 'map',
            layers: [osmLayer, vectorLayer],
            view: view,
            controls: [
                new ol.control.Zoom(),
                new ol.control.Attribution(),
                new ol.control.FullScreen(),
                new ol.control.ScaleLine()
            ]
        });

        function switchMapTheme(theme) {
            var newLayer;

            if (theme === 'imagery') {
                newLayer = new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                        attributions: '© Esri'
                    })
                });
            } else if (theme === 'street') {
                newLayer = new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
                        attributions: '© Esri'
                    })
                });
            } else if (theme === 'osm') {
                newLayer = new ol.layer.Tile({
                    source: new ol.source.OSM()
                });
            } else if (theme === 'esri') {
                newLayer = new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        url: 'https://services.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}',
                        attributions: '© Esri'
                    })
                });
            }

            map.getLayers().setAt(0, newLayer);
        }

        $('#submit-filter').click(function() {
            var tahun = $('#tahun').val();
            var bulan = $('#bulan').val();
            var jenisPenyakit = $('#jenisPenyakit').val();
            var wilayah = $('#wilayah').val();

            if (!tahun || !bulan || !jenisPenyakit) {
                toastr.warning('Mohon lengkapi semua filter.');
                return;
            }

            $('#deskripsi-wilayah').text(wilayah);

            $.ajax({
                url: '{{ route('peta.filter') }}',
                method: 'GET',
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    jenis_penyakit: jenisPenyakit,
                    wilayah: wilayah
                },
                success: function(response) {
                    vectorSource.clear();

                    var newVectorLayer = new ol.layer.Vector({
                        source: vectorSource,
                        style: function(feature) {
                            var tingkatKa = feature.get('tingkat_ka') || 'Tinggi';
                            // ubah warna
                            var colorMap = {
                                'Tinggi': 'rgba(0, 255, 0, 0.6)',
                                'Sedang': 'rgba(255, 0, 0, 0.6)',
                                'Rendah': 'rgba(0, 0, 255, 0.6)'
                            };
                            var fillColor = colorMap[tingkatKa.toString()] || 'rgba(0, 255, 0, 0.6)';
                            return new ol.style.Style({
                                fill: new ol.style.Fill({
                                    color: fillColor
                                }),
                                stroke: new ol.style.Stroke({
                                    color: '#333',
                                    width: 1
                                })
                            });
                        }
                    });

                    var data_penyakit = response.data_penyakit;

                    Object.keys(response).forEach(function(key) {
                        response[key].forEach(function(item) {
                            var feature = new ol.format.GeoJSON().readFeature({
                                'type': 'Feature',
                                'geometry': JSON.parse(item.geometry)
                            }, {
                                dataProjection: 'EPSG:4326',
                                featureProjection: 'EPSG:3857'
                            });
                            feature.set('tingkat_ka', item.tingkat_ka || 'Tinggi');
                            vectorSource.addFeature(feature);
                        });
                    });
                    map.addLayer(newVectorLayer);
                    toastr.success('Data berhasil dimuat!');
                    if (!map.getLayers().getArray().includes(vectorLayer)) {
                        map.addLayer(vectorLayer);
                    }
                },
                error: function() {
                    toastr.error('Gagal memuat data.');
                }
            });

        });
    </script>

    <script>
        document.getElementById("screenshot-btn").addEventListener("click", function() {
            html2canvas(document.body).then(function(canvas) {
                var link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'screenshot.png';
                link.click()
            });
        });
    </script>

    @stack('script')

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

    <!-- CKEditor 5 -->
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.0/"
            }
        }
    </script>

</body>

</html>

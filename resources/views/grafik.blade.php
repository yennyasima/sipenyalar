@extends('layouts.landingpage')
@section('title', 'GIS - GRAFIK')

@section('content')
    <div id="filter"
        class="fixed right-10 border border-slate-200 z-30 top-36 rounded w-fit h-fit p-4 bg-white drop-shadow-md hidden">
        <h1>Filter</h1>
        <div class="flex space-x-4">
            <div id="filter-tahun">
                <h1>Tahun</h1>
            </div>
            <div id="filter-bulan">
                <h1>Bulan</h1>
            </div>
        </div>
    </div>
    <div class="flex mt-20 z-10 fixed">
        @include('components.grafik.sideBarGraph')
        <div class="">
            <h1 id="title" class="font-bold text-2xl mb-4">Grafik Terbaru</h1>
            <div class="flex space-x-2">
                <div class="p-4 bg-white h-[750px] overflow-scroll drop-shadow-lg rounded border border-slate-200">
                    <canvas id="chart" class="pb-7 h-[750px] overflow-scroll"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const tableName = {!! json_encode($tableName) !!}.toString().split('\\')[2]
        const latestData = {!! json_encode($allData) !!}
        const currentYear = new Date().getFullYear().toString()

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        const yValues = latestData.filter(item => item.tanggal.split('-')[0] == currentYear).map(item => tableName == 'KasusHiv' ? item.ha_kasus : tableName == 'HotspotHiv' ? item
            .ha_kasus : tableName == 'PendudukMiskinHiv' ? item.pdd_miskin : tableName == 'TunaSusilaHiv' ? item
            .tn_susila : tableName == 'PendudukPriaProduktivHiv' ?
            item.pdd_lk_pro : tableName == 'WilayahRentanHiv' ?
            item.nilai_wr : tableName == 'CurahHujanIspa' ? item.curah_hujan :
            tableName == 'DataPenyakitIspa' ? item.jumlah_ispa_penderita : tableName == 'KelembapanIspa' ? item
            .kelembapan :
            tableName == 'KepadatanPendudukIspa' ? item.kpdt_bps : tableName == 'SuhuIspa' ? item.suhu :
            tableName == 'DataPenyakitDbd' ? item.kasus : tableName == 'FaktorLingkunganDbd' ? item.suhu :
            tableName == 'kepadatanPendudukDbd' ? item.kepadatan : 'tidak ada data')
        const xValues = latestData.filter(item => item.tanggal.split('-')[0] == currentYear).map(item => tableName == 'DataPenyakitDbd' || tableName == 'FaktorLingkunganDbd' ||
            tableName == 'KepadatanPendudukDbd' ?
            item.kelurahan : item.kecamatan)
        const barColors = latestData.map(() => getRandomColor());
        const ctx = document.getElementById('chart').getContext('2d');

        currentChart = new Chart(ctx, {
            type: tableName === 'DataPenyakitDbd' || tableName === 'FaktorLingkunganDbd' || tableName ===
                'KepadatanPendudukDbd' ? 'bar' : 'pie',
            data: {
                labels: xValues.length !== 0 ? xValues : ['tidak ada Data'],
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues.length !== 0 ? yValues : [1]
                }]
            },
            options: {
                layout: {
                    padding: {
                        top: 10,
                        bottom: 8,
                        left: 20,
                        right: 20
                    }
                },
                legend: {
                    display: tableName === 'DataPenyakitDbd' || tableName === 'FaktorLingkunganDbd' || tableName ===
                        'KepadatanPendudukDbd' ? false : true,
                    position: 'left',
                    labels: {
                        fontSize: 14,
                        boxWidth: 35
                    }
                },
                title: {
                    display: true,
                    text: `Data Tahun ${currentYear}`,
                    fontSize: 18
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                },
            }
        });
    </script>
@endsection

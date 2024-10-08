@extends('layouts.landingpage')
@section('title', 'GIS - GRAFIK')

@section('content')
    <button id="hamburger"
        class="fixed group p-2 space-y-2 hover:bg-slate-100 right-10 h-14 w-14 mt-20 z-30 bg-white rounded border border-slate-400">
        <div class="w-full h-1 bg-[#D95639]"></div>
        <div class="w-full h-1 bg-[#D95639]"></div>
        <div class="w-full h-1 bg-[#D95639]"></div>
        <div id="tooltip"
            class="absolute font-semibold text-center hidden group-hover:block p-2 bg-black bg-opacity-70 text-white top-12 left-0 w-full rounded">
            Filter</div>
    </button>
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
            <h1 id="title" class="font-bold text-2xl mb-4">Kasus DBD</h1>
            <div class="flex space-x-2">
                <div class="p-4 bg-white h-[750px] overflow-scroll drop-shadow-lg rounded border border-slate-200">
                    <canvas id="chart" class="pb-7 h-[750px] overflow-scroll"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const baseDataDBD = {!! json_encode($dbdData) !!};
        const hamburger = document.getElementById('hamburger');
        const filter = document.getElementById('filter');
        const penyakitDbd = baseDataDBD.penyakit;
        const kepadatanDbd = baseDataDBD.kepadatanPenduduk;
        const faktorLingkunganDbd = baseDataDBD.faktorLingkungan;
        const filterTahunContainer = document.getElementById('filter-tahun');
        const filterBulanContainer = document.getElementById('filter-bulan');
        const kasusDbdParam = document.getElementById('kasus-dbd')
        const kepadatanDbdParam = document.getElementById('kepadatan-dbd')
        const lingkunganDbdParam = document.getElementById('lingkungan-dbd')
        const title = document.getElementById('title')
        const currentYear = new Date().getFullYear().toString();
        const currentMonth = new Date().getMonth();
        const dbdButtonContainer = document.getElementById('dbd-container')
        let currentChart;

        let selectedData = penyakitDbd;

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        function resetFilter() {
            filterBulanContainer.innerHTML = ''
            filterTahunContainer.innerHTML = ''
        }


        document.addEventListener('DOMContentLoaded', function() {
            // Render diagram untuk tahun saat ini
            if (kasusDbdParam.classList.contains('font-bold')) {
                kasusDbdParam.classList.remove('font-bold')
            } else {
                kasusDbdParam.classList.add('font-bold')
            }
            renderDiagram(selectedData.filter(item => item.tanggal.split('-')[0] == currentYear), currentYear);
            resetFilter()
            renderFilter(selectedData)
        });

        function renderFilter(selectedData) {

            const yearData = new Set(selectedData.filter(item => item.tanggal.split('-')[0] !== currentYear).map(item =>
                item
                .tanggal.split('-')[0]));
            const monthData = monthNames

            yearData.add(currentYear);

            const arrayYears = Array.from(yearData).sort((a, b) => b - a);
            const arrayMonth = Array.from(monthData).sort();
            arrayMonth.map((item, index) => {
                const inputElement = document.createElement('div');
                const input = `
                    <input type="checkbox" name="penyakit-dbd" value=${('0' + (index + 1)).slice(-2)} id="bulan-${'0' + (index + 1)}">
                    <label for="bulan-${item}">${monthNames[index]}</label>
                `;
                inputElement.innerHTML = input;
                filterBulanContainer.append(inputElement);
            });

            arrayYears.map(item => {
                const inputElement = document.createElement('div');
                const input = `
                    <input type="radio" name="penyakit-dbd" value=${item} id="tahun-${item}">
                    <label for="tahun-${item}">${item}</label>
                `;
                inputElement.innerHTML = input;
                filterTahunContainer.append(inputElement);
            });

            function enableCheckbox(enable) {
                filterBulan.forEach(checkbox => {
                    checkbox.disabled = !enable
                })
            }

            function getSelectedMonths() {
                const selectedMonths = [];
                filterBulan.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedMonths.push(checkbox.value);
                    }
                });
                return selectedMonths;
            }

            const filterTahun = document.querySelectorAll('input[name="penyakit-dbd"]');
            const filterBulan = document.querySelectorAll('input[type="checkbox"][name="penyakit-dbd"]');

            filterTahun.forEach(radio => {
                radio.addEventListener('click', function() {
                    const selectedYear = this.value;
                    filterData(selectedYear, getSelectedMonths());
                    enableCheckbox(true)
                });
            });

            filterBulan.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selectedYear = document.querySelector('input[name="penyakit-dbd"]:checked')
                        ?.value ||
                        currentYear;
                    filterData(selectedYear, getSelectedMonths());
                });
            });

            enableCheckbox(false)
        }
        const filterTahun = document.querySelectorAll('input[name="penyakit-dbd"]');
        const filterBulan = document.querySelectorAll('input[type="checkbox"][name="penyakit-dbd"]');

        function filterData(year, months) {
            let filteredData = selectedData.filter(item => item.tanggal.split('-')[0] == year);

            if (months.length > 0) {
                filteredData = filteredData.filter(item => months.includes(item.tanggal.split('-')[1]));
            }

            renderDiagram(filteredData, year);
        }

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        hamburger.addEventListener('click', function() {
            if (filter.classList.contains('hidden')) {
                document.getElementById('tooltip').classList.remove('group-hover:block');
                filter.classList.remove('hidden');
            } else {
                filter.classList.add('hidden');
                document.getElementById('tooltip').classList.add('group-hover:block');
            }
        });

        // Fungsi untuk memfilter data berdasarkan tahun dan bulan
        kasusDbdParam.addEventListener('click', function() {
            title.innerHTML = 'Kasus DBD'
            kasusDbdParam.classList.add('font-bold')
            kepadatanDbdParam.classList.remove('font-bold')
            lingkunganDbdParam.classList.remove('font-bold')
            selectedData = penyakitDbd
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        kepadatanDbdParam.addEventListener('click', function() {
            title.innerHTML = 'Kepadatan Penduduk'
            kepadatanDbdParam.classList.add('font-bold')
            kasusDbdParam.classList.remove('font-bold')
            lingkunganDbdParam.classList.remove('font-bold')
            selectedData = kepadatanDbd
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        lingkunganDbdParam.addEventListener('click', function() {
            title.innerHTML = 'Faktor Lingkungan (Curah Hujan)'
            lingkunganDbdParam.classList.add('font-bold')
            kepadatanDbdParam.classList.remove('font-bold')
            kasusDbdParam.classList.remove('font-bold')
            selectedData = faktorLingkunganDbd
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })

        // Fungsi untuk membuat diagram chart
        function renderDiagram(filteredData, year) {
            const xValues = filteredData.map(item => item.kecamatan);
            const yValues = filteredData.map(item => selectedData == kepadatanDbd ? item.kepadatan : selectedData ==
                penyakitDbd ? item.kasus : selectedData == faktorLingkunganDbd ? item.curah_hujan : 0 || 0);
            const barColors = filteredData.map(() => getRandomColor());
            const ctx = document.getElementById('chart').getContext('2d');

            if (currentChart) {
                currentChart.destroy();
            }

            currentChart = new Chart(ctx, {
                type: "bar",
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
                        display: false,
                        position: 'left',
                        labels: {
                            fontSize: 14,
                            boxWidth: 35
                        }
                    },
                    title: {
                        display: true,
                        text: `Data Tahun ${year}`,
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
        }
    </script>

@endsection

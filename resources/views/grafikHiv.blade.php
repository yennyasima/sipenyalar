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
            <h1 id="title" class="font-bold text-2xl mb-4">Kasus HIV</h1>
            <div class="flex space-x-2">
                <div class="p-4 bg-white h-[750px] overflow-scroll drop-shadow-lg rounded border border-slate-200">
                    <canvas id="chart" class="pb-7 h-[750px] overflow-scroll"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const baseDataHIV = {!! json_encode($hivData) !!};
        const hamburger = document.getElementById('hamburger');
        const filter = document.getElementById('filter');
        const kasusHiv = baseDataHIV.kasus;
        const hotspotHiv = baseDataHIV.hotspot;
        const pendudukMiskinHiv = baseDataHIV.pendudukMiskin;
        const usiaProduktifHiv = baseDataHIV.usiaProduktif;
        const tunaSusilaHiv = baseDataHIV.tunaSusila;
        const wilayahRentanHiv = baseDataHIV.wilayahRentan;
        const filterTahunContainer = document.getElementById('filter-tahun');
        const filterBulanContainer = document.getElementById('filter-bulan');
        const kasusHivParam = document.getElementById('kasus-hiv')
        const hotspotHivParam = document.getElementById('hotspot-hiv')
        const pendudukMiskinParam = document.getElementById('penduduk-miskin')
        const priaProduktifParam = document.getElementById('pria-produktif')
        const tunaSusilaParam = document.getElementById('tuna-susila')
        const wilayahRentanParam = document.getElementById('wilayah-rentan')
        const title = document.getElementById('title')
        const currentYear = new Date().getFullYear().toString();
        const currentMonth = new Date().getMonth();
        const hivButtonContainer = document.getElementById('hiv-container')
        let currentChart;

        let selectedData = kasusHiv;

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        function resetFilter() {
            filterBulanContainer.innerHTML = ''
            filterTahunContainer.innerHTML = ''
        }


        document.addEventListener('DOMContentLoaded', function() {
            // Render diagram untuk tahun saat ini
            if (kasusHivParam.classList.contains('font-bold')) {
                kasusHivParam.classList.remove('font-bold')
            } else {
                kasusHivParam.classList.add('font-bold')
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
            const arrayMonth = Array.from(monthData).sort((a, b) => b - a);

            arrayMonth.map((item, index) => {
                const inputElement = document.createElement('div');
                const input = `
                    <input type="checkbox" name="penyakit-hiv" value=${('0' + (index + 1)).slice(-2)} id="bulan-${'0' + (index + 1)}">
                    <label for="bulan-${item}">${monthNames[index]}</label>
                `;
                inputElement.innerHTML = input;
                filterBulanContainer.append(inputElement);
            });

            arrayYears.map(item => {
                const inputElement = document.createElement('div');
                const input = `
                    <input type="radio" name="penyakit-hiv" value=${item} id="tahun-${item}">
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

            const filterTahun = document.querySelectorAll('input[name="penyakit-hiv"]');
            const filterBulan = document.querySelectorAll('input[type="checkbox"][name="penyakit-hiv"]');

            filterTahun.forEach(radio => {
                radio.addEventListener('click', function() {
                    const selectedYear = this.value;
                    filterData(selectedYear, getSelectedMonths());
                    enableCheckbox(true)
                });
            });

            filterBulan.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selectedYear = document.querySelector('input[name="penyakit-hiv"]:checked')
                        ?.value ||
                        currentYear;
                    filterData(selectedYear, getSelectedMonths());
                });
            });

            enableCheckbox(false)
        }
        const filterTahun = document.querySelectorAll('input[name="penyakit-hiv"]');
        const filterBulan = document.querySelectorAll('input[type="checkbox"][name="penyakit-hiv"]');

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
        kasusHivParam.addEventListener('click', function() {
            title.innerHTML = 'Kasus HIV'
            kasusHivParam.classList.add('font-bold')
            hotspotHivParam.classList.remove('font-bold')
            tunaSusilaParam.classList.remove('font-bold')
            wilayahRentanParam.classList.remove('font-bold')
            priaProduktifParam.classList.remove('font-bold')
            selectedData = kasusHiv
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        hotspotHivParam.addEventListener('click', function() {
            title.innerHTML = 'Hotspot HIV'
            kasusHivParam.classList.remove('font-bold')
            hotspotHivParam.classList.add('font-bold')
            tunaSusilaParam.classList.remove('font-bold')
            wilayahRentanParam.classList.remove('font-bold')
            priaProduktifParam.classList.remove('font-bold')
            pendudukMiskinParam.classList.remove('font-bold')
            selectedData = hotspotHiv
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        pendudukMiskinParam.addEventListener('click', function() {
            title.innerHTML = 'Penduduk Miskin'
            kasusHivParam.classList.remove('font-bold')
            hotspotHivParam.classList.remove('font-bold')
            tunaSusilaParam.classList.remove('font-bold')
            wilayahRentanParam.classList.remove('font-bold')
            priaProduktifParam.classList.remove('font-bold')
            pendudukMiskinParam.classList.add('font-bold')
            selectedData = hotspotHiv
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        tunaSusilaParam.addEventListener('click', function() {
            title.innerHTML = 'Tuna Susila'
            kasusHivParam.classList.remove('font-bold')
            hotspotHivParam.classList.remove('font-bold')
            tunaSusilaParam.classList.add('font-bold')
            wilayahRentanParam.classList.remove('font-bold')
            priaProduktifParam.classList.remove('font-bold')
            pendudukMiskinParam.classList.remove('font-bold')
            selectedData = tunaSusilaHiv
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        wilayahRentanParam.addEventListener('click', function() {
            title.innerHTML = 'Wilayah Rentan HIV'
            kasusHivParam.classList.remove('font-bold')
            hotspotHivParam.classList.remove('font-bold')
            tunaSusilaParam.classList.remove('font-bold')
            wilayahRentanParam.classList.add('font-bold')
            priaProduktifParam.classList.remove('font-bold')
            pendudukMiskinParam.classList.remove('font-bold')
            selectedData = wilayahRentanHiv
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        priaProduktifParam.addEventListener('click', function() {
            title.innerHTML = 'Wilayah Rentan HIV'
            kasusHivParam.classList.remove('font-bold')
            hotspotHivParam.classList.remove('font-bold')
            tunaSusilaParam.classList.remove('font-bold')
            wilayahRentanParam.classList.remove('font-bold')
            priaProduktifParam.classList.add('font-bold')
            pendudukMiskinParam.classList.remove('font-bold')
            selectedData = usiaProduktifHiv
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })


        // Fungsi untuk membuat diagram chart
        function renderDiagram(filteredData, year) {
            const xValues = filteredData.map(item => item.kecamatan);
            const yValues = filteredData.map(item => selectedData == kasusHiv ? item.ha_kasus : selectedData ==
                hotspotHiv ? item
                .ha_kasus : selectedData == pendudukMiskinHiv ? item.pdd_miskin : selectedData == tunaSusilaHiv ? item
                .tn_susila : selectedData == usiaProduktifHiv ?
                item.pdd_lk_pro : selectedData == wilayahRentanHiv ?
                item.nilai_wr : 0);
            const barColors = filteredData.map(() => getRandomColor());
            const ctx = document.getElementById('chart').getContext('2d');

            if (currentChart) {
                currentChart.destroy();
            }

            currentChart = new Chart(ctx, {
                type: "pie",
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
                        display: true,
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

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
            <h1 id="title" class="font-bold text-2xl mb-4">Kasus Ispa</h1>
            <div class="flex space-x-2">
                <div class="p-4 bg-white h-[750px] overflow-scroll drop-shadow-lg rounded border border-slate-200">
                    <canvas id="chart" class="pb-7 h-[750px] overflow-scroll"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const baseDataIspa = {!! json_encode($ispaData) !!};
        const hamburger = document.getElementById('hamburger');
        const filter = document.getElementById('filter');
        const penyakitIspa = baseDataIspa.penyakit;
        const kepadatanIspa = baseDataIspa.kepadatanPenduduk;
        const curahHujanIspa = baseDataIspa.curahHujan;
        const suhuIspa = baseDataIspa.suhu;
        const kelembapanIspa = baseDataIspa.kelembapan;
        const filterTahunContainer = document.getElementById('filter-tahun');
        const filterBulanContainer = document.getElementById('filter-bulan');
        const kasusIspaParam = document.getElementById('kasus-ispa')
        const kepadatanIspaParam = document.getElementById('kepadatan-ispa')
        const suhuIspaParam = document.getElementById('suhu-ispa')
        const kelembapanIspaParam = document.getElementById('kelembapan-ispa')
        const curahIspaParam = document.getElementById('curah-ispa')
        const title = document.getElementById('title')
        const currentYear = new Date().getFullYear().toString();
        const currentMonth = new Date().getMonth();
        const ispaButtonContainer = document.getElementById('ispa-container')
        let currentChart;

        let selectedData = penyakitIspa;

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        function resetFilter() {
            filterBulanContainer.innerHTML = ''
            filterTahunContainer.innerHTML = ''
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Render diagram untuk tahun saat ini
            if (kasusIspaParam.classList.contains('font-bold')) {
                kasusIspaParam.classList.remove('font-bold')
            } else {
                kasusIspaParam.classList.add('font-bold')
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
        kasusIspaParam.addEventListener('click', function() {
            title.innerHTML = 'Kasus ISPA'
            kasusIspaParam.classList.add('font-bold')
            kepadatanIspaParam.classList.remove('font-bold')
            suhuIspaParam.classList.remove('font-bold')
            curahIspaParam.classList.remove('font-bold')
            kelembapanIspaParam.classList.remove('font-bold')
            selectedData = penyakitIspa
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        kepadatanIspaParam.addEventListener('click', function() {
            title.innerHTML = 'Kepadatan Penduduk ISPA'
            kasusIspaParam.classList.remove('font-bold')
            kepadatanIspaParam.classList.add('font-bold')
            suhuIspaParam.classList.remove('font-bold')
            curahIspaParam.classList.remove('font-bold')
            kelembapanIspaParam.classList.remove('font-bold')
            selectedData = kepadatanIspa
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        suhuIspaParam.addEventListener('click', function() {
            title.innerHTML = 'Suhu Lingkungan'
            kasusIspaParam.classList.remove('font-bold')
            kepadatanIspaParam.classList.remove('font-bold')
            suhuIspaParam.classList.add('font-bold')
            curahIspaParam.classList.remove('font-bold')
            kelembapanIspaParam.classList.remove('font-bold')
            selectedData = suhuIspa
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        curahIspaParam.addEventListener('click', function() {
            title.innerHTML = 'Curah Hujan Lingkungan'
            kasusIspaParam.classList.remove('font-bold')
            kepadatanIspaParam.classList.remove('font-bold')
            suhuIspaParam.classList.remove('font-bold')
            curahIspaParam.classList.add('font-bold')
            kelembapanIspaParam.classList.remove('font-bold')
            selectedData = curahHujanIspa
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })
        kelembapanIspaParam.addEventListener('click', function() {
            title.innerHTML = 'Kelembapan Lingkungan'
            kasusIspaParam.classList.remove('font-bold')
            kepadatanIspaParam.classList.remove('font-bold')
            suhuIspaParam.classList.remove('font-bold')
            curahIspaParam.classList.remove('font-bold')
            kelembapanIspaParam.classList.add('font-bold')
            selectedData = kelembapanIspa
            filterData(currentYear, currentMonth)
            resetFilter()
            renderFilter(selectedData)
        })

        // Fungsi untuk membuat diagram chart
        function renderDiagram(filteredData, year) {
            const xValues = filteredData.map(item => item.kecamatan);
            const yValues = filteredData.map(item => selectedData == curahHujanIspa ? item.ch :
                selectedData == penyakitIspa ? item.jumlah_ispa_penderita : selectedData == kelembapanIspa ? item
                .kelembapan : selectedData == kepadatanIspa ? item.kpdt_bps : selectedData == suhuIspa ? item.suhu :
                '' ||
                0);
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

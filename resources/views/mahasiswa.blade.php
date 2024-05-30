<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/core.css" />

    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>
    <script src="{{ asset('assets') }}/js/config.js"></script>
    <style>
        .menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            /* Mengatur posisi horizontal menjadi tengah */
            align-items: center;
            /* Mengatur posisi vertikal menjadi tengah */
        }

        .menu li {
            margin-right: 20px;
            /* Jarak antar menu */
        }

        .menu li:last-child {
            margin-right: 0;
            /* Menghilangkan margin-right untuk menu terakhir */
        }

        .menu li a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            background-color: #cfe2ff;
            /* Warna latar belakang biru langit muda soft */
            transition: background-color 0.3s;
        }

        .menu li a:hover {
            background-color: #a9d4ff;
            /* Warna latar belakang saat dihover */
        }

        #menus {
            background-color: #f0f8ff;
            /* Warna latar belakang untuk container */
            padding: 20px;
            border-radius: 8px;
            /* Membuat sudut sedikit melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Menambahkan bayangan */
        }

    </style>
</head>

<body>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <div class="layout-page">
                <div class="content-wrapper">
                    <div id="menus" class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="logo">
                                    <img src="https://data.usk.ac.id/assets/images/logo.png" alt="Logo USK"
                                        style="max-width: 50px;">

                                </div>
                            </div>
                            <div class="col-md-8 d-flex align-items-center justify-content-end">
                                <ul class="menu">
                                    <li><a href="{{ url('mahasiswa') }}">Mahasiswa</a></li>
                                    <li><a href="{{ url('pengajar') }}">Pengajar Prodi</a></li>
                                    <li><a href="#">Riwayat</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <!-- Basic Layout -->
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Filter Data</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="filterForm"
                                            class="row d-flex align-items-center justify-content-between">
                                            <div class="row mb-3 col-md-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="angkatan" id="angkatan"
                                                            class="select2 form-select" data-allow-clear="true">
                                                            <option value="2023">2023</option>
                                                            @foreach($angkatan as $tahun)
                                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="angkatan">Tahun</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 col-md-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="jenjang" id="jenjang" class="select2 form-select"
                                                            data-allow-clear="true">

                                                        </select>
                                                        <label for="jenjang">Jenjang</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 col-md-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="fakultas" id="fakultas"
                                                            class="select2 form-select" data-allow-clear="true">

                                                        </select>
                                                        <label for="fakultas">Fakultas</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 col-md-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="prodi" id="prodi" class="select2 form-select"
                                                            data-allow-clear="true">

                                                        </select>
                                                        <label for="prodi">Prodi</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div id="results"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-8 col-12 mb-4">
                                <div class="card">
                                    <div class="card-header header-elements">
                                        <div class="d-flex flex-column">
                                            <h5 class="card-title mb-1">Data Berdasarkan Angkatan</h5>
                                            <p class="text-muted mb-0">Total Data : <span id="totalData"></p>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <canvas id="horizontalBarChart" class="chartjs" data-height="480"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 mb-4">
                                <div class="card">
                                    <h5 class="card-header">Data Berdasarkan Jenis Kelamin</h5>
                                    <div class="card-body">
                                        <canvas id="doughnutChart" class="chartjs mb-4" data-height="400"></canvas>
                                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                            <li class="ct-series-0 d-flex flex-column">
                                                <h5 class="mb-0">Laki- Laki</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(102, 110, 232); width: 35px; height: 6px"></span>
                                                <div id="Laki-Laki" class="text-muted">0 %</div>
                                            </li>
                                            <li class="ct-series-1 d-flex flex-column">
                                                <h5 class="mb-0">Perempuan</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(40, 208, 148); width: 35px; height: 6px"></span>
                                                <div id="Perempuan" class="text-muted">0 %</div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 mb-4">
                                <div class="card">
                                    <div class="card-header header-elements">
                                        <h5 class="card-title mb-0">Data Berdasarkan IPK</h5>

                                    </div>
                                    <div class="card-body">
                                        <canvas id="polarChart" class="chartjs" data-height="337"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-12 mb-4">
                                <div class="card">
                                    <div class="card-header header-elements">
                                        <h5 class="card-title mb-0">Data Berdasarkan Jalur Masuk</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="barChart" class="chartjs" data-height="340"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>


    <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/chartjs/chartjs.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>
    <script>
        $(document).ready(function () {
            function firstLoad() {
                // Mengambil URL untuk route 'dynamic' menggunakan Laravel
                let firstRoutes = `{{ route('dynamic') }}`;

                // Mengirim permintaan AJAX untuk mendapatkan data
                $.ajax({
                    type: 'GET',
                    url: firstRoutes,
                    success: function (response) {
                        // Bersihkan opsi sebelumnya di elemen-elemen HTML
                        $('#jenjang').empty();
                        $('#fakultas').empty();
                        $('#prodi').empty();

                        // Mendefinisikan array dengan ID elemen HTML
                        const numberObj = ['jenjang', 'fakultas', 'prodi'];

                        // Tambahkan opsi default ke elemen-elemen HTML
                        $('#jenjang').append('<option value="all">-- Semua --</option>');
                        $('#fakultas').append('<option value="all">-- Semua --</option>');
                        $('#prodi').append('<option value="all">-- Semua --</option>');
                        let loopCount = 0;
                        // Loop melalui array numberObj untuk menyesuaikan opsi
                        for (let ab = 0; ab < response.length; ab++) {
                            for (let bc = 0; bc < response[ab].length; bc++) {
                                // console.log(response[ab][bc]);
                                $('#' + numberObj[ab]).append('<option value="' + response[ab][bc] +
                                    '">' + response[ab][bc] + '</option>');
                                loopCount++;
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            $('#jenjang').change(function () {
                var jenjangValue = $(this).val();
                let jenjangRoutes = `{{ route('jj', ['value' => ':val']) }}`;
                jenjangRoutes = jenjangRoutes.replace(':val', jenjangValue)
                // Kirim permintaan Ajax
                $.ajax({
                    type: 'GET',
                    url: jenjangRoutes,
                    success: function (data) {
                        console.log(data);
                        // Bersihkan opsi sebelumnya
                        $('#fakultas').empty();
                        $('#prodi').empty();

                        // Tambahkan opsi baru dari data yang diterima
                        $('#fakultas').append('<option value="all">-- Semua --</option>');
                        $.each(data, function (index, value) {
                            $('#fakultas').append('<option value="' + value + '">' +
                                value + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $('#fakultas').change(function () {
                var fakultasValue = $(this).val();
                let fakultasRoutes = `{{ route('fk', ['value' => ':val']) }}`;
                fakultasRoutes = fakultasRoutes.replace(':val', fakultasValue)
                // Kirim permintaan Ajax
                $.ajax({
                    type: 'GET',
                    url: fakultasRoutes,
                    success: function (data) {
                        console.log(data);
                        // Bersihkan opsi sebelumnya
                        $('#prodi').empty();

                        // Tambahkan opsi baru dari data yang diterima
                        $('#prodi').append('<option value="all">-- Semua --</option>');
                        $.each(data, function (index, value) {
                            $('#prodi').append('<option value="' + value + '">' +
                                value + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $('#angkatan').change(function () {
                firstLoad();
            });
            firstLoad();
        });

    </script>
    <script>
        $(document).ready(function () {
            let instanceCart1; // Variable to store the chart instance
            let instanceCart2; // Variable to store the chart instance
            let instanceCart3; // Variable to store the chart instance
            let instanceCart4; // Variable to store the chart instance
            const purpleColor = '#836AF9',
                yellowColor = '#ffe800',
                cyanColor = '#28dac6',
                orangeColor = '#FF8132',
                orangeLightColor = '#ffcf5c',
                oceanBlueColor = '#299AFF',
                greyColor = '#4F5D70',
                greyLightColor = '#EDF1F4',
                blueColor = '#2B9AFF',
                blueLightColor = '#84D0FF';
            let cardColor, headingColor, labelColor, borderColor, legendColor;
            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                headingColor = config.colors_dark.headingColor;
                labelColor = config.colors_dark.textMuted;
                legendColor = config.colors_dark.bodyColor;
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                headingColor = config.colors.headingColor;
                labelColor = config.colors.textMuted;
                legendColor = config.colors.bodyColor;
                borderColor = config.colors.borderColor;
            }
            const chartList = document.querySelectorAll('.chartjs');
            chartList.forEach(function (chartListItem) {
                chartListItem.height = chartListItem.dataset.height;
            });

            function loadChartData(year, jenjang, fakultas, prodi) {
                $.ajax({
                    url: `{{ route('mhs.data') }}`,
                    method: 'GET',
                    data: {
                        angkatan: year,
                        jenjang: jenjang,
                        fakultas: fakultas,
                        prodi: prodi
                    },
                    success: function (response) {

                        $("#totalData").text(response.total);
                        const groupedData = groupBy(response.data, 'prodi_mhs');
                        const prodiCounts = Object.keys(groupedData).map(prodi => {
                            return {
                                prodi_mhs: prodi,
                                total: groupedData[prodi].length
                            };
                        });

                        // Sort by total number of students and get top 8
                        const top8Prodi = prodiCounts.sort((a, b) => b.total - a.total).slice(0,
                            10);

                        const labels = top8Prodi.map(item => item.prodi_mhs);
                        const data = top8Prodi.map(item => item.total);
                        // Update all charts with new data
                        updateChart('horizontalBarChart', labels, data);

                        // Mengelompokkan data berdasarkan jenis kelamin
                        const groupedByGender = groupBy(response.data, 'kelamin_mhs');

                        // Membuat array untuk menyimpan total jumlah mahasiswa per jenis kelamin
                        const genderCounts = [];
                        const genderLabels = [];

                        if (groupedByGender['L']) {
                            genderCounts.push(groupedByGender['L'].length);
                            genderLabels.push('Laki-Laki');
                        } else {
                            genderCounts.push(0);
                            genderLabels.push('Laki-Laki');
                        }

                        if (groupedByGender['P']) {
                            genderCounts.push(groupedByGender['P'].length);
                            genderLabels.push('Perempuan');
                        } else {
                            genderCounts.push(0);
                            genderLabels.push('Perempuan');
                        }

                        const totalGenders = genderCounts.reduce((acc, val) => acc + val, 0);

                        // Update grafik donat dengan data total per jenis kelamin
                        genderCart(genderCounts, genderLabels);

                        // Update legend dengan persentase
                        updateLegend(genderCounts, totalGenders);
                        // Memproses data untuk grafik polar area berdasarkan IPK dan jenis kelamin
                        const ipkData = groupDataByIpkAndGender(response.data);
                        ipkPolarChart(ipkData);

                        const jalurMasukData = countMahasiswaByJalurMasuk(response.data);

                        // Filter data dengan total di atas 20
                        const filteredJalurMasukData = filterDataByTotal(jalurMasukData, 20);

                        // Proses data untuk grafik batang berdasarkan jalur masuk
                        jalurMasukBarChart(filteredJalurMasukData);

                    }
                });
            }

            function filterDataByTotal(data, threshold) {
                const filteredData = {};
                for (const key in data) {
                    if (data.hasOwnProperty(key) && data[key] > threshold) {
                        filteredData[key] = data[key];
                    }
                }
                return filteredData;
            }

            function countMahasiswaByJalurMasuk(data) {
                const counts = {};
                data.forEach(mahasiswa => {
                    const jalurMasuk = mahasiswa.jalur_masuk;
                    counts[jalurMasuk] = (counts[jalurMasuk] || 0) + 1;
                });
                return counts;
            }

            function groupBy(array, key) {
                return array.reduce((result, currentValue) => {
                    (result[currentValue[key]] = result[currentValue[key]] || []).push(currentValue);
                    return result;
                }, {});
            }

            function updateChart(chartId, labels, data) {
                if (instanceCart1) {
                    instanceCart1.destroy();
                }
                const horizontalBarChart = document.getElementById('horizontalBarChart');
                if (horizontalBarChart) {
                    instanceCart1 = new Chart(horizontalBarChart, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: cyanColor,
                                borderColor: 'transparent',
                                maxBarThickness: 15
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 500
                            },
                            elements: {
                                bar: {
                                    borderRadius: {
                                        topRight: 15,
                                        bottomRight: 15
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    min: 0,
                                    grid: {
                                        color: borderColor,
                                        borderColor: borderColor
                                    },
                                    ticks: {
                                        color: labelColor
                                    }
                                },
                                y: {
                                    grid: {
                                        borderColor: borderColor,
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: labelColor
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function genderCart(genderTotal, genderData) {
                if (instanceCart2) {
                    instanceCart2.destroy();
                }
                const genderCartPie = document.getElementById('doughnutChart');
                if (genderCartPie) {
                    instanceCart2 = new Chart(genderCartPie, {
                        type: 'doughnut',
                        data: {
                            labels: genderData,
                            datasets: [{
                                data: genderTotal,
                                backgroundColor: [cyanColor, orangeLightColor, config.colors
                                    .primary
                                ],
                                borderWidth: 0,
                                pointStyle: 'rectRounded'
                            }]
                        },
                        options: {
                            responsive: true,
                            animation: {
                                duration: 500
                            },
                            cutout: '68%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            const label = context.label || '';
                                            const value = context.raw;
                                            const output = ' ' + label + ' : ' + value +
                                                ' Mahasiswa';
                                            return output;
                                        }
                                    },
                                    // Updated default tooltip UI
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                }
                            }
                        }
                    });
                }
            }

            function groupDataByIpkAndGender(data) {
                const ipkRanges = {
                    'IPK: 0.00-2.00': {
                        min: 0.00,
                        max: 2.00,
                        L: 0,
                        P: 0
                    },
                    'IPK: 2.01-2.50': {
                        min: 2.01,
                        max: 2.50,
                        L: 0,
                        P: 0
                    },
                    'IPK: 2.51-3.00': {
                        min: 2.51,
                        max: 3.00,
                        L: 0,
                        P: 0
                    },
                    'IPK: 3.01-3.50': {
                        min: 3.01,
                        max: 3.50,
                        L: 0,
                        P: 0
                    },
                    'IPK: 3.51-4.00': {
                        min: 3.51,
                        max: 4.00,
                        L: 0,
                        P: 0
                    }
                };

                data.forEach(student => {
                    const ipk = parseFloat(student.ipk_mhs);
                    const gender = student.kelamin_mhs;

                    for (const range in ipkRanges) {
                        if (ipk >= ipkRanges[range].min && ipk <= ipkRanges[range].max) {
                            ipkRanges[range][gender]++;
                            break;
                        }
                    }
                });

                return ipkRanges;
            }

            function updateLegend(genderCounts, total) {
                const lakiLakiPercent = ((genderCounts[0] / total) * 100).toFixed(2);
                const perempuanPercent = ((genderCounts[1] / total) * 100).toFixed(2);

                document.getElementById('Laki-Laki').innerText = `${lakiLakiPercent} %`;
                document.getElementById('Perempuan').innerText = `${perempuanPercent} %`;
            }
            loadChartData(2023, null, null, null);

            function ipkPolarChart(ipkData) {
                if (instanceCart3) {
                    instanceCart3.destroy();
                }
                const ipkCart = document.getElementById('polarChart');
                if (polarChart) {
                    const labels = Object.keys(ipkData);
                    const dataLakiLaki = labels.map(range => ipkData[range]['L']);
                    const dataPerempuan = labels.map(range => ipkData[range]['P']);
                    const nonEmptyLabels = [];
                    const nonEmptyDataLakiLaki = [];
                    const nonEmptyDataPerempuan = [];

                    // Memeriksa apakah ada data yang tersedia untuk setiap rentang IPK
                    labels.forEach((range, index) => {
                        if (dataLakiLaki[index] > 0 || dataPerempuan[index] > 0) {
                            nonEmptyLabels.push(range);
                            nonEmptyDataLakiLaki.push(dataLakiLaki[index]);
                            nonEmptyDataPerempuan.push(dataPerempuan[index]);
                        }
                    });

                    const backgroundColors = generateRandomColors(nonEmptyLabels.length);

                    instanceCart3 = new Chart(polarChart, {
                        type: 'polarArea',
                        data: {
                            labels: nonEmptyLabels,
                            datasets: [{
                                    label: 'Laki-Laki',
                                    backgroundColor: backgroundColors,
                                    borderColor: 'rgba(255, 255, 255, 1)',
                                    borderWidth: 1,
                                    data: nonEmptyDataLakiLaki
                                },
                                {
                                    label: 'Perempuan',
                                    backgroundColor: backgroundColors,
                                    borderColor: 'rgba(255, 255, 255, 1)',
                                    borderWidth: 1,
                                    data: nonEmptyDataPerempuan
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 500
                            },
                            scales: {
                                r: {
                                    ticks: {
                                        display: false,
                                        color: labelColor
                                    },
                                    grid: {
                                        circular: true
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    // Updated default tooltip UI
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                },
                                legend: {
                                    rtl: isRtl,
                                    position: 'right',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 25,
                                        boxWidth: 8,
                                        boxHeight: 8,
                                        color: legendColor,
                                        font: {
                                            family: 'Inter'
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function jalurMasukBarChart(data) {
                if (instanceCart4) {
                    instanceCart4.destroy();
                }
                const jalurMasukChart = document.getElementById('barChart');
                if (jalurMasukChart) {
                    const jalurMasukLabels = Object.keys(data);
                    const jalurMasukData = Object.values(data);
                    instanceCart4 = new Chart(jalurMasukChart, {
                        type: 'bar',
                        data: {
                            labels: jalurMasukLabels,
                            datasets: [{
                                data: jalurMasukData,
                                backgroundColor: orangeLightColor,
                                borderColor: 'transparent',
                                maxBarThickness: 50,
                                borderRadius: {
                                    topRight: 15,
                                    topLeft: 15
                                }
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 500
                            },
                            plugins: {
                                tooltip: {
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        color: borderColor,
                                        drawBorder: false,
                                        borderColor: borderColor
                                    },
                                    ticks: {
                                        color: labelColor
                                    }
                                },
                                y: {
                                    min: 0,
                                    grid: {
                                        color: borderColor,
                                        drawBorder: false,
                                        borderColor: borderColor
                                    },
                                    ticks: {
                                        stepSize: 100,
                                        color: labelColor
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function generateRandomColors(numColors) {
                const colors = [];
                for (let i = 0; i < numColors; i++) {
                    const color =
                        `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.5)`;
                    colors.push(color);
                }
                return colors;
            }
            $('#angkatan, #jenjang, #fakultas, #prodi').change(function () {
                const year = $('#angkatan').val();
                const jenjang = $('#jenjang').val();
                const fakultas = $('#fakultas').val();
                const prodi = $('#prodi').val();
                loadChartData(year, jenjang, fakultas, prodi);
            });
        });

    </script>



</body>

</html>

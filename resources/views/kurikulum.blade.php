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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .semester-header {
            background-color: #d9d9d9;
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
        }
    </style>
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
                                    <img src="#" alt="Logo USK"
                                        style="max-width: 50px;">

                                </div>
                            </div>
                            <div class="col-md-8 d-flex align-items-center justify-content-end">
                                <ul class="menu">
                                    <li><a href="{{ url('/') }}">Beranda</a></li>
                                    <li><a href="{{ url('mahasiswa') }}">Mahasiswa</a></li>
                                    <li><a href="{{ url('pengajar') }}">Pengajar Prodi</a></li>
                                    <li><a href="{{ url('kurikulum') }}">Kurikulum</a></li>
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
                                            class="row ">
                                            <div class="row mb-3 col-md-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="jenjang" id="jenjang" class="select2 form-select"
                                                            data-allow-clear="true">
                                                                <option value="all">-- Semua --</option>
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
                                                                <option value="all">-- Semua --</option>
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
                                                            <option value="all">-- Semua --</option>
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
                            <div class="col-xl-12 col-12 mb-4">
                                <div class="card">
                                    <div class="card-header header-elements">
                                        <div class="d-flex flex-column">
                                            <h5 class="card-title mb-1">Mata Kuliah</h5>
                                            <p class="text-muted mb-0">Total Data : <span id="totalData"></p>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <canvas id="horizontalBarChart" class="chartjs" data-height="480"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-12 mb-4">
                                <div class="card">
                                    <div class="card-header header-elements">
                                        <h5 class="card-title mb-0">Data Tabular</h5>
                                    </div>
                                    <div class="card-body">
<table id="mataKuliahTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>(K-P-L)</th>
                <th>Kategori</th>
                <th>Prasyarat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here by JavaScript -->
        </tbody>
    </table>
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
        let instanceCart1;
        $(document).ready(function () {
            function firstLoad() {
                // Mengambil URL untuk route 'dynamic' menggunakan Laravel
                let firstRoutes = `{{ route('k.dynamic') }}`;
                getDataWithFillter();
                // Mengirim permintaan AJAX untuk mendapatkan data
                $.ajax({
                    type: 'GET',
                    url: firstRoutes,
                    success: function (response) {
                        // Bersihkan opsi sebelumnya di elemen-elemen HTML
                        $('#jenjang').empty();
                        $('#fakultas').empty();
                        $('#prodi').empty();
                        $('#jenjang').append('<option value="all">-- Semua --</option>');
                        $('#fakultas').append('<option value="all">-- Semua --</option>');
                        $('#prodi').append('<option value="all">-- Semua --</option>');
                        // Mendefinisikan array dengan ID elemen HTML
                        const numberObj = ['jenjang', 'fakultas', 'prodi'];

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

            $('#jenjang').on('change', function() {

                let jenjangValue = $(this).val();
                let routesJenjang = `{{ route('k.jj', ['value' => ':value']) }}`;
                routesJenjang = routesJenjang.replace(':value', jenjangValue);
                $('#prodi').empty();
                $('#prodi').append('<option value="all">-- Semua --</option>');
                getDataWithFillter();
                $.ajax({
                    type: 'GET',
                    url: routesJenjang,
                    success: function (data) {
                        $('#fakultas').empty();
                        $('#fakultas').append('<option value="all">-- Semua --</option>');
                        $.each(data, function (index, value) {
                            $('#fakultas').append('<option value="' + value.fakultas_mk + '">' +
                                value.fakultas_mk + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('#fakultas').on('change', function() {
                let fakultasValue = $(this).val();
                let routesFakultas = `{{ route('k.fk', ['value' => ':value']) }}`;
                routesFakultas = routesFakultas.replace(':value', fakultasValue);
                getDataWithFillter();
                $.ajax({
                    type: 'GET',
                    url: routesFakultas,
                    success: function (data) {
                        $('#prodi').empty();
                        $('#prodi').append('<option value="all">-- Semua --</option>');
                        $.each(data, function (index, value) {

                            $('#prodi').append('<option value="' + value.prodi_mk + '">' +
                                value.prodi_mk + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('#prodi').on('change', function() {
                let prodiValue = $(this).val();
                let routesProdi = `{{ route('k.pd', ['value' => ':value']) }}`;
                routesProdi = routesProdi.replace(':value', prodiValue);
                getDataWithFillter();
                $.ajax({
                    type: 'GET',
                    url: routesProdi,
                    success: function (data) {
                        $.each(data, function (index, value) {
                            $('#prodi').append('<option value="' + value.prodi_mk + '">' +
                                value.prodi_mk + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });



            function getDataWithFillter() {
                let jenjang   = $('#jenjang').val();
                let fakultas  = $('#fakultas').val();
                let prodi     = $('#prodi').val();
                // console.log(jenjang, fakultas, prodi);
                let routesKurikulum = `{{ route('kurikulum.data', ['jenjang' => ':jenjang', 'fakultas' => ':fakultas', 'prodi' => ':prodi']) }}`;
                routesKurikulum = routesKurikulum.replace(':jenjang', encodeURIComponent(jenjang));
                routesKurikulum = routesKurikulum.replace(':fakultas', encodeURIComponent(fakultas));
                routesKurikulum = routesKurikulum.replace(':prodi', encodeURIComponent(prodi));
                // console.log(routesKurikulum);
                $.ajax({
                    type: 'GET',
                    url: routesKurikulum,
                    success: function (data) {
                        $('#totalData').text(data.length)
                        console.log(data);
                        createChart(data);
                        populateTable(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function createChart(data) {
                const semesterCounts = data.reduce((acc, curr) => {
                    acc[curr.semester_mk] = (acc[curr.semester_mk] || 0) + 1;
                    return acc;
                }, {});

                const labels = Object.keys(semesterCounts);
                const values = Object.values(semesterCounts);

                if (instanceCart1) {
                    instanceCart1.destroy();
                }
                const ctx = document.getElementById('horizontalBarChart').getContext('2d');
                instanceCart1 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Mata Kuliah',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            function populateTable(data) {
                const tableBody = $('#mataKuliahTable tbody');
                tableBody.empty();

                let currentSemester = '';
                let totalSKS = 0;
                let no = 1;

                data.forEach((item, index) => {
                    if (item.semester_mk !== currentSemester) {
                        if (currentSemester !== '') {
                            const totalRow = `<tr class="total-row">
                                <td colspan="3">TOTAL</td>
                                <td>${totalSKS}</td>
                                <td colspan="3"></td>
                            </tr>`;
                            tableBody.append(totalRow);
                        }

                        currentSemester = item.semester_mk;
                        totalSKS = 0;
                        const semesterHeader = `<tr class="semester-header">
                            <td colspan="7">${currentSemester}</td>
                        </tr>`;
                        tableBody.append(semesterHeader);
                    }

                    totalSKS += item.sks_mk;

                    const row = `<tr>
                        <td>${no++}</td>
                        <td>${item.kode_mk}</td>
                        <td>${item.mk}</td>
                        <td>${item.sks_mk}</td>
                        <td>${item.kpl_mk}</td>
                        <td>${item.kategori_mk}</td>
                        <td>${item.prasyarat_mk || ''}</td>
                    </tr>`;
                    tableBody.append(row);
                });

                const finalTotalRow = `<tr class="total-row">
                    <td colspan="3">TOTAL</td>
                    <td>${totalSKS}</td>
                    <td colspan="3"></td>
                </tr>`;
                tableBody.append(finalTotalRow);
            }
            firstLoad();
        });

    </script>



</body>

</html>

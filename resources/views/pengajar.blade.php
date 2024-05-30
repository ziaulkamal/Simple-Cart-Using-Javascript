<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Data Pengajar</title>
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
                                                        <select name="jenjang" id="jenjang"
                                                            class="select2 form-select" data-allow-clear="true">
                                                            <option value="all">-- Semua --</option>
                                                            <option value="d3_ngajar">D3</option>
                                                            <option value="s1_ngajar">S1</option>
                                                            <option value="s2_ngajar">S2</option>
                                                            <option value="s3_ngajar">S3</option>
                                                            <option value="profesi">Profesi</option>

                                                        </select>
                                                        <label for="angkatan">Jenjang</label>
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
                                            <h5 class="card-title mb-1">Top 10 Data Pengajar</h5>
                                            <p class="text-muted mb-0">Total Kelas : <span id="totalData"></p>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <canvas id="myChart" class="chartjs" data-height="480"></canvas>
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
    $(document).ready(function () {
        function prepareChartData(data) {
            let groupedData = {};

            // Mengelompokkan data berdasarkan nama koordinator dan menghitung jumlah kelas ngajar
            data.forEach(pengajar => {
                 if (pengajar.koordinator && pengajar.koordinator.trim() !== "") {
                    let namaKoordinator = pengajar.koordinator;
                    let jumlahKelas = parseInt(pengajar.d3_ngajar) + parseInt(pengajar.s1_ngajar) + parseInt(pengajar.s2_ngajar) + parseInt(pengajar.s3_ngajar) + parseInt(pengajar.profesi);

                    // Jika nama koordinator belum ada dalam objek groupedData, inisialisasi jumlah kelas dengan 0
                    if (!groupedData[namaKoordinator]) {
                        groupedData[namaKoordinator] = 0;
                    }

                    // Tambahkan jumlah kelas ke dalam jumlah kelas yang sudah ada untuk nama koordinator tersebut
                    groupedData[namaKoordinator] += jumlahKelas;
                }
            });

            // Mengubah objek menjadi array agar dapat diurutkan
            let dataArray = Object.entries(groupedData);

            // Mengurutkan array berdasarkan jumlah kelas secara descending
            dataArray.sort((a, b) => b[1] - a[1]);

            // Mengambil hanya 10 data pertama
            let top10Data = dataArray.slice(1, 11);

            return top10Data;
        }

        function loadData(jenjang) {
            // Mengambil URL untuk route 'filter.pengajar' menggunakan Laravel dan menambahkan parameter jenjang
            let filterRoute = `{{ route('filter.pengajar') }}?jenjang=${jenjang}`;

            // Mengirim permintaan AJAX untuk mendapatkan data
            $.ajax({
                type: 'GET',
                url: filterRoute,
                success: function (response) {
                    $('#totalData').text(response.total)
                    // Memproses data menggunakan fungsi prepareChartData
                    let chartData = prepareChartData(response.data);
                    if (instanceCart1) {
                        instanceCart1.destroy();
                    }
                    // Membuat chart menggunakan data yang sudah diproses
                    var ctx = document.getElementById('myChart').getContext('2d');
                    instanceCart1 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chartData.map(item => item[0]), // Nama-nama koordinator
                            datasets: [{
                                label: 'Jumlah Kelas Ngajar',
                                data: chartData.map(item => item[1]), // Jumlah kelas ngajar
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error); // Log error ke konsol jika terjadi kesalahan saat mengambil data
                }
            });
        }

        // Event listener untuk perubahan pada select dengan id 'jenjang'
        $('#jenjang').on('change', function () {
            let jenjang = $(this).val();
            if (jenjang) {
                loadData(jenjang);
            } else {
                $('#resultContainer').empty(); // Mengosongkan container jika tidak ada pilihan
            }
        });

        // Load data saat halaman pertama kali dimuat dengan nilai default dari select
        let initialJenjang = $('#jenjang').val();
        if (initialJenjang) {
            loadData(initialJenjang);
        }
    });


    </script>




</body>

</html>

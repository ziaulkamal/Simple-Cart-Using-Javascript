<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Cart</title>
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
                                    <li><a href="#">Mahasiswa</a></li>
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
    <script src="{{ asset('assets/js/cart-function.js') }}" type="text/javascript"></script>
    {{-- @include('cart') --}}




</body>

</html>

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
                                    <li><a href="{{ url('/') }}">Beranda</a></li>
                                    <li><a href="{{ url('mahasiswa') }}">Mahasiswa</a></li>
                                    <li><a href="{{ url('pengajar') }}">Pengajar Prodi</a></li>
                                    <li><a href="{{ url('kurikulum') }}">Kurikulum</a></li>
                                    <li><a href="#">Riwayat</a></li>
                                </ul>
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



</body>

</html>

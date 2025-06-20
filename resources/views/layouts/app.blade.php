<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .nav-link.active {
            font-weight: bold;
            background-color: #e2e6ea;
        }
        .nav-link-toggle::after {
            content: " ▾";
            float: right;
        }
        .nav-link-toggle.collapsed::after {
            content: " ▸";
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/obat') }}">Manajemen Obat & Pasien</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-3">
                <h5>Menu</h5>
                <div class="accordion" id="sidebarAccordion">
                    <!-- Obat Section -->
                    <div class="accordion-item border-0">
                        <a class="nav-link nav-link-toggle collapsed" data-bs-toggle="collapse" href="#obatMenu" role="button" aria-expanded="false">
                            💊 Obat
                        </a>
                        <div class="collapse {{ request()->is('obat*') ? 'show' : '' }}" id="obatMenu" data-bs-parent="#sidebarAccordion">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('obat') ? 'active' : '' }}" href="{{ url('/obat') }}">📋 Tampil Obat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('obat/tambah') ? 'active' : '' }}" href="{{ url('/obat/tambah') }}">➕ Tambah Obat</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Pasien Section -->
                    <div class="accordion-item border-0">
                        <a class="nav-link nav-link-toggle collapsed" data-bs-toggle="collapse" href="#pasienMenu" role="button" aria-expanded="false">
                            🧑‍⚕️ Pasien
                        </a>
                        <div class="collapse {{ request()->is('pasien*') ? 'show' : '' }}" id="pasienMenu" data-bs-parent="#sidebarAccordion">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('pasien') ? 'active' : '' }}" href="{{ url('/pasien') }}">📋 Tampil Pasien</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('pasien/tambah') ? 'active' : '' }}" href="{{ url('/pasien/tambah') }}">➕ Tambah Pasien</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

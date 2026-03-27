<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIBI — @yield('title', 'Sistema')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .sidebar { min-height: calc(100vh - 56px); background: #1e293b; }
        .sidebar .nav-link { color: #94a3b8; padding: .5rem 1rem; border-radius: 6px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #334155; color: #fff; }
        .sidebar .nav-section { color: #475569; font-size: .7rem; text-transform: uppercase;
                                 letter-spacing: 1px; padding: .8rem 1rem .2rem; }
        .content-area { padding: 2rem; }
        .table th { background: #1e293b; color: #fff; }
        .btn-sm { border-radius: 4px; }
        .flash { position: fixed; top: 70px; right: 20px; z-index: 9999; min-width: 280px; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="{{ route('servicios.index') }}">
        <i class="bi bi-book-half me-2"></i>SIBI
    </a>
</nav>

<div class="d-flex">
    {{-- SIDEBAR --}}
    <nav class="sidebar col-md-2 p-3">
        <span class="nav-section">Servicios</span>
        <a href="{{ route('servicios.index') }}"
           class="nav-link {{ request()->routeIs('servicios.*') ? 'active':'' }}">
            <i class="bi bi-calendar-check me-2"></i>Servicios
        </a>

        <span class="nav-section">Usuarios</span>
        <a href="{{ route('usuarios.index') }}"
           class="nav-link {{ request()->routeIs('usuarios.*') ? 'active':'' }}">
            <i class="bi bi-people me-2"></i>Usuarios
        </a>

        <span class="nav-section">Estructura SIBI</span>
        <a href="{{ route('areas.index') }}"
           class="nav-link {{ request()->routeIs('areas.*') ? 'active':'' }}">
            <i class="bi bi-diagram-3 me-2"></i>Áreas
        </a>
        <a href="{{ route('componentes.index') }}"
           class="nav-link {{ request()->routeIs('componentes.*') ? 'active':'' }}">
            <i class="bi bi-boxes me-2"></i>Componentes
        </a>
        <a href="{{ route('lineas.index') }}"
           class="nav-link {{ request()->routeIs('lineas.*') ? 'active':'' }}">
            <i class="bi bi-menu-button-wide me-2"></i>Líneas
        </a>
        <a href="{{ route('tipos_actividad.index') }}"
           class="nav-link {{ request()->routeIs('tipos_actividad.*') ? 'active':'' }}">
            <i class="bi bi-tag me-2"></i>Tipos de actividad
        </a>

        <span class="nav-section">Institución</span>
        <a href="{{ route('sedes.index') }}"
           class="nav-link {{ request()->routeIs('sedes.*') ? 'active':'' }}">
            <i class="bi bi-building me-2"></i>Sedes
        </a>
    </nav>

    {{-- CONTENIDO --}}
    <main class="col-md-10 content-area">
        {{-- Alertas flash --}}
        @if(session('success'))
        <div class="flash alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="flash alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
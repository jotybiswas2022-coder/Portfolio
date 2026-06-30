<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Laravel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://junait.com/tiny_pro.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}">

    <style>
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1039;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    .sidebar-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }
    .admin-main {
        margin-left: 260px !important;
        min-height: calc(100vh - 57px);
        background: #f1f5f9;
        padding: 1.5rem;
    }
    @media (max-width: 767.98px) {
        .admin-main {
            margin-left: 0 !important;
            padding: 1rem;
        }
    }
    </style>
</head>
<body>

    {{-- Sidebar Overlay (mobile off-canvas) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- Top Navigation Bar --}}
    @include('backend.partials.topbar')

    {{-- Admin Layout: Sidebar + Content --}}
    <div class="admin-layout">

        {{-- Sidebar --}}
        @include('backend.partials.sidebar')

        {{-- Main Content --}}
        <main class="admin-main">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>

    @yield('scripts')
</body>

</html>

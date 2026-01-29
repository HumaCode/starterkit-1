<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Components - Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/modal.css') }}">

    @stack('css')
</head>
<body>
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- SIDEBAR -->
    @include('layouts.partials.sidebar')

    <!-- HEADER -->
    @include('layouts.partials.header')


    <!-- MAIN CONTENT -->
    <main class="main-content" id="mainContent">
        {{ $slot }}
    </main>

    <!-- ==================== FLOATING BUTTON ==================== -->
    <button class="float-btn" id="floatBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- SCRIPTS -->
    <script src="{{ asset('assets/backend/js/modal.js') }}"></script>

    @stack('js')
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                </a>
            </div>

            <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}


<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Selamat Datang</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/backend/css/auth/style.css') }}" />

    @stack('auth-css')
</head>

<body>
    <!-- Animated Bubbles Background -->
    <div class="bubbles-container">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <!-- Loading Modal -->
    <div class="loading-modal" id="loadingModal">
        <div class="loading-content">
            <div class="spinner-wrapper">
                <div class="spinner"></div>
            </div>
            <div class="loading-text">Mohon Tunggu</div>
            <div class="loading-subtext">Sedang memproses...</div>
        </div>
    </div>

    <!-- Alert Messages -->
    <div id="alertOverlay">
        <div id="alertContainer"></div>
    </div>

    <!-- Login Wrapper -->
    <div class="login-wrapper">
        {{ $slot }}
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="{{ asset('assets/backend/js/auth/script.js') }}"></script>

    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            easing: "ease-out-cubic",
        });

        // Setup CSRF Token for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Show Loading Modal
        function showLoading() {
            $('#loadingModal').addClass('show');
        }

        // Hide Loading Modal
        function hideLoading() {
            $('#loadingModal').removeClass('show');
        }

        // Show Alert Popup (SweetAlert Style)
        function showAlert(message, type = 'danger') {
            const icon = type === 'danger' ? 'exclamation-circle' : 'check-circle';
            const title = type === 'danger' ? 'Oops!' : 'Berhasil!';

            const alertHtml = `
                <div class="alert alert-${type}">
                    <div class="alert-icon-wrapper">
                        <i class="bi bi-${icon}"></i>
                    </div>
                    <div class="alert-title">${title}</div>
                    <div class="alert-message">${message}</div>
                </div>
            `;

            $('#alertContainer').html(alertHtml);
            $('#alertOverlay').addClass('show'); // ← INI KUNCI

            setTimeout(() => {
                $('#alertOverlay').removeClass('show');

                setTimeout(() => {
                    $('#alertContainer').html('');
                }, 300);
            }, 3000);
        }

    </script>

    @stack('auth-js')
</body>

</html>

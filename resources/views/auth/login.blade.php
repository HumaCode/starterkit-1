<x-guest-layout>
    @push('auth-js')
    <script>
        // Handle Login Form Submit
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            // Disable button
            const $btnLogin = $('#btnLogin');
            $btnLogin.prop('disabled', true);

            // Show loading modal
            showLoading();

            // Clear previous alerts
            $('#alertContainer').html('');

            // Get form data
            const formData = {
                identitas: $('#identitas').val()
                , password: $('#password').val()
                , remember: $('#remember').is(':checked') ? 1 : 0
                , _token: $('input[name="_token"]').val()
            };

            // AJAX Request
            $.ajax({
                url: '{{ route("login") }}'
                , type: 'POST'
                , data: formData
                , dataType: 'json'
                , success: function(response) {
                    // Hide loading
                    hideLoading();

                    // Show success message
                    showAlert(response.message || 'Login berhasil! Mengalihkan...', 'success');

                    // Redirect after 1 second
                    setTimeout(function() {
                        window.location.href = response.redirect || '/dashboard';
                    }, 1000);
                }
                , error: function(xhr) {
                    // Hide loading
                    hideLoading();

                    // Enable button
                    $btnLogin.prop('disabled', false);

                    // Handle errors
                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        if (errors.identitas) {
                            errorMessage = errors.identitas[0];
                        } else if (errors.password) {
                            errorMessage = errors.password[0];
                        } else {
                            errorMessage = 'Terjadi kesalahan validasi.';
                        }

                        showAlert(errorMessage, 'danger');
                    } else if (xhr.status === 401) {
                        // Unauthorized (wrong credentials)
                        showAlert(xhr.responseJSON.message || 'Username atau password salah!', 'danger');
                    } else if (xhr.status === 403) {
                        // Forbidden (inactive user)
                        showAlert(xhr.responseJSON.message || 'Akun Anda tidak aktif!', 'danger');
                    } else {
                        // Other errors
                        showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                    }
                }
            });
        });

        // Interactive Bubbles - Mouse Movement Effect
        document.addEventListener("mousemove", (e) => {
            const bubbles = document.querySelectorAll(".bubble");
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            bubbles.forEach((bubble, index) => {
                const speed = (index + 1) * 0.5;
                const x = (mouseX - 0.5) * speed * 30;
                const y = (mouseY - 0.5) * speed * 30;

                bubble.style.transform = `translate(${x}px, ${y}px)`;
            });
        });

    </script>
    @endpush

    <div class="login-card" data-aos="fade-up" data-aos-duration="1000">
        <!-- Logo -->
        <div class="logo-wrapper" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="800">
            <div class="logo-icon">
                <i class="bi bi-box-seam"></i>
            </div>
        </div>

        <!-- Welcome Text -->
        <div class="welcome-text" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
            <h1>Selamat Datang! 👋</h1>
            <p>Silakan masuk ke akun Anda</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form id="loginForm"  method="POST">
            @csrf

            <!-- Username -->
            <div class="form-group" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                <label for="identitas" class="form-label">Username</label>
                <div class="input-wrapper">
                    <input type="text" class="form-control" id="identitas" name="identitas" placeholder="Masukkan username Anda" required autocomplete="username" />
                    <i class="bi bi-person input-icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required autocomplete="current-password" />
                    <i class="bi bi-lock input-icon"></i>
                    <button type="button" class="password-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Remember & Forgot -->
            <div class="remember-forgot" data-aos="fade-up" data-aos-delay="600" data-aos-duration="800">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                @endif

            </div>

            <!-- Login Button -->
            <div data-aos="fade-up" data-aos-delay="700" data-aos-duration="800">
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="divider" data-aos="fade-up" data-aos-delay="800" data-aos-duration="800">
            <span>atau</span>
        </div>

        <!-- Register Link -->
        <div class="divider" data-aos="fade-up" data-aos-delay="900" data-aos-duration="800">
            <p>Belum punya akun? <a href="#">Daftar</a></p>
        </div>
    </div>
</x-guest-layout>

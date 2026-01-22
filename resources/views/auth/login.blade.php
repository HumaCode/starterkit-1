<x-guest-layout>
    {{-- <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}

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

        <!-- Login Form -->
        <form action="#" method="POST">
            <!-- Username -->
            <div class="form-group" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                <label for="username" class="form-label">Username</label>
                <div class="input-wrapper">
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Masukkan username Anda" required autocomplete="username" />
                    <i class="bi bi-person input-icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan password Anda" required autocomplete="current-password" />
                    <i class="bi bi-lock input-icon"></i>
                    <button type="button" class="password-toggle" onclick="togglePassword()"
                        aria-label="Toggle password visibility">
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
                <a href="#" class="forgot-link">Lupa password?</a>
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

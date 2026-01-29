<x-master-layout>

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/backend/css/dashboard.css') }}">
    @endpush

    @push('js')
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('assets/backend/js/dashboard.js') }}"></script>
    @endpush

    <!-- Welcome Section -->
    <div class="welcome-section" data-aos="fade-up">
        <h1>Selamat Datang, {{ user('full') }}! 👋</h1>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card-header">
                <div class="stat-icon blue">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up"></i>
                    12.5%
                </div>
            </div>
            <div class="stat-value">2,847</div>
            <div class="stat-label">Total Pengguna</div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card-header">
                <div class="stat-icon green">
                    <i class="bi bi-cart-check"></i>
                </div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up"></i>
                    8.2%
                </div>
            </div>
            <div class="stat-value">1,254</div>
            <div class="stat-label">Total Pesanan</div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card-header">
                <div class="stat-icon purple">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-trend down">
                    <i class="bi bi-arrow-down"></i>
                    3.1%
                </div>
            </div>
            <div class="stat-value">Rp 89.5M</div>
            <div class="stat-label">Total Pendapatan</div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card-header">
                <div class="stat-icon orange">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up"></i>
                    15.3%
                </div>
            </div>
            <div class="stat-value">458</div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="charts-grid">
        <!-- Line Chart -->
        <div class="chart-card" data-aos="fade-up" data-aos-delay="100">
            <div class="chart-header">
                <h3 class="chart-title">Statistik Penjualan</h3>
                <div class="chart-filter">
                    <button class="filter-btn active">Minggu</button>
                    <button class="filter-btn">Bulan</button>
                    <button class="filter-btn">Tahun</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="chart-card" data-aos="fade-up" data-aos-delay="200">
            <div class="chart-header">
                <h3 class="chart-title">Kategori Produk</h3>
            </div>
            <div class="chart-container">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Activity Section -->
    <div class="charts-grid">
        <div class="activity-card" data-aos="fade-up" data-aos-delay="100">
            <div class="chart-header">
                <h3 class="chart-title">Aktivitas Terbaru</h3>
            </div>

            <div class="activity-item">
                <div class="activity-icon order">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="activity-content">
                    <h6>Pesanan baru #ORD-2847</h6>
                    <p>Customer: Ahmad Suryadi</p>
                </div>
                <span class="activity-time">5 menit lalu</span>
            </div>

            <div class="activity-item">
                <div class="activity-icon user">
                    <i class="bi bi-person-plus"></i>
                </div>
                <div class="activity-content">
                    <h6>User baru terdaftar</h6>
                    <p>Siti Nurhaliza bergabung</p>
                </div>
                <span class="activity-time">15 menit lalu</span>
            </div>

            <div class="activity-item">
                <div class="activity-icon payment">
                    <i class="bi bi-credit-card"></i>
                </div>
                <div class="activity-content">
                    <h6>Pembayaran diterima</h6>
                    <p>Rp 2.500.000 dari #ORD-2845</p>
                </div>
                <span class="activity-time">32 menit lalu</span>
            </div>

            <div class="activity-item">
                <div class="activity-icon order">
                    <i class="bi bi-truck"></i>
                </div>
                <div class="activity-content">
                    <h6>Pesanan dikirim</h6>
                    <p>#ORD-2840 dalam pengiriman</p>
                </div>
                <span class="activity-time">1 jam lalu</span>
            </div>

            <div class="activity-item">
                <div class="activity-icon user">
                    <i class="bi bi-star"></i>
                </div>
                <div class="activity-content">
                    <h6>Review baru</h6>
                    <p>Budi memberikan rating 5 bintang</p>
                </div>
                <span class="activity-time">2 jam lalu</span>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="chart-card" data-aos="fade-up" data-aos-delay="200">
            <div class="chart-header">
                <h3 class="chart-title">Penjualan per Kategori</h3>
            </div>
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

</x-master-layout>

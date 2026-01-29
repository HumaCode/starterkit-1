<header class="main-header" id="mainHeader">
    <div class="header-left">
        <button class="toggle-sidebar" id="toggleSidebar"><i class="bi bi-list"></i></button>
        <span class="page-title">Dashboard</span>
    </div>
    <div class="header-right">
        <button class="header-btn" id="themeToggle"><i class="bi bi-sun" id="themeIcon"></i></button>
        <button class="header-btn"><i class="bi bi-bell"></i><span class="notification-badge">3</span></button>
        <div class="user-dropdown" id="userDropdown">
            <button class="user-toggle" onclick="toggleUserDropdown()">
                <div class="user-avatar">JD</div>
                <span class="user-name">John Doe</span>
            </button>
            <div class="dropdown-menu-user">
                <div class="dropdown-header"><h6>John Doe</h6><p>john@example.com</p></div>
                <a href="#" class="dropdown-item-custom">
                    <i class="bi bi-person"></i>
                    <span>Profile Saya</span>
                  </a>
                  <a href="#" class="dropdown-item-custom">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                  </a>
                  <a href="#" class="dropdown-item-custom">
                    <i class="bi bi-credit-card"></i>
                    <span>Billing</span>
                  </a>
                  <a href="#" class="dropdown-item-custom">
                    <i class="bi bi-bell"></i>
                    <span>Notifikasi</span>
                  </a>
                <div class="dropdown-item-custom logout"  onclick="openModal('modalLogout')"><i class="bi bi-box-arrow-right"></i><span>Logout</span></div>
            </div>
        </div>
    </div>
</header>


<!-- Modal Logout -->
<div class="modal-overlay" id="modalLogout" onclick="closeModalOnOverlay(event, 'modalLogout')">
    <div class="modal modal-confirm animate-flip">
        <div class="modal-body text-center">
            <div class="modal-icon logout">
                <i class="bi bi-box-arrow-right"></i>
            </div>
            <h3>Logout?</h3>
            <p>Apakah Anda yakin ingin keluar dari akun ini?</p>
            <div class="modal-buttons">
                <button class="btn btn-secondary" onclick="closeModal('modalLogout')"><i class="bi bi-x"></i> Tidak</button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-purple" onclick="event.preventDefault(); this.closest('form').submit();"><i class="bi bi-box-arrow-right"></i> Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
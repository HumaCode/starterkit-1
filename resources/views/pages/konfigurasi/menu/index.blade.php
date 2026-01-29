<x-master-layout>

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/backend/css/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/css/table.css') }}">
    @endpush

    @push('js')
        <script src="{{ asset('assets/backend/js/table.js') }}"></script>

        <script>
            // ==================== CUSTOM DROPDOWN ====================

            document.querySelectorAll(".custom-select").forEach((select) => {
                const trigger = select.querySelector(".custom-select-trigger");
                const options = select.querySelectorAll(".custom-option");
                const triggerSpan = trigger.querySelector("span");

                // Toggle dropdown
                trigger.addEventListener("click", (e) => {
                    e.stopPropagation();
                    // Close other dropdowns
                    document.querySelectorAll(".custom-select.open").forEach((s) => {
                        if (s !== select) s.classList.remove("open");
                    });
                    select.classList.toggle("open");
                });

                // Select option
                options.forEach((option) => {
                    option.addEventListener("click", () => {
                        // Remove selected from all options
                        options.forEach((opt) => opt.classList.remove("selected"));
                        // Add selected to clicked option
                        option.classList.add("selected");
                        // Update trigger text
                        triggerSpan.textContent = option.textContent.trim();
                        // Update data-value
                        select.dataset.value = option.dataset.value;
                        // Close dropdown
                        select.classList.remove("open");
                    });
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", (e) => {
                if (!e.target.closest(".custom-select")) {
                    document.querySelectorAll(".custom-select.open").forEach((select) => {
                        select.classList.remove("open");
                    });
                }
            });
        </script>
    @endpush

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>{{ $title }}</h1>
            <p>{{ $subtitle }}</p>
        </div>
        <div class="page-header-right">
            <nav class="breadcrumb-nav">
                <a href="dashboard.html"><i class="bi bi-house"></i> Home</a>
                <span class="separator"><i class="bi bi-chevron-right"></i></span>
                <span class="current">{{ $title }}</span>
            </nav>
        </div>
    </div>

    <!-- Content Area - Tambahkan konten Anda di sini -->
    <div class="content-wrapper">


        <!-- Contoh Grid 3 Kolom -->
        @include('pages.konfigurasi.menu.partials.grid')

        <!-- Contoh Card Kosong -->
        <div class="card">
            <div class="card-header">
                <h3><i class="bi bi-file-earmark-text"></i> {{ $label }}</h3>
                <div class="card-actions">
                    <button class="btn-add" onclick="showAddModal()">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="user-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="filter-section">
                        <div class="filter-left">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" placeholder="Cari nama, email, atau username..." />
                            </div>

                            <!-- Custom Dropdown Status -->
                            <div class="custom-select" data-value="">
                                <div class="custom-select-trigger">
                                    <span>Semua Status</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="custom-options">
                                    <div class="custom-option selected" data-value="">
                                        Semua Status
                                    </div>
                                    <div class="custom-option" data-value="active">
                                        <span class="option-dot active"></span>Active
                                    </div>
                                    <div class="custom-option" data-value="inactive">
                                        <span class="option-dot inactive"></span>Inactive
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="filter-right">
                            <span class="entries-info">Tampilkan</span>

                            <!-- Custom Dropdown Entries -->
                            <div class="custom-select entries" data-value="10">
                                <div class="custom-select-trigger">
                                    <span>10</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="custom-options">
                                    <div class="custom-option selected" data-value="10">10</div>
                                    <div class="custom-option" data-value="25">25</div>
                                    <div class="custom-option" data-value="50">50</div>
                                    <div class="custom-option" data-value="75">75</div>
                                    <div class="custom-option" data-value="100">100</div>
                                </div>
                            </div>

                            <span class="entries-info">data</span>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Nama Menu
                                    </th>
                                    <th>
                                        Kategori
                                    </th>
                                    <th>
                                        order
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="text-center user-info-avatar">
                                                <i class="bi bi-grid-1x2"></i>
                                            </div>
                                            <div class="user-info-details">
                                                <h6>Menu</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>MENU MANAGEMENT</td>
                                    <td>1</td>
                                    <td>
                                        <span class="status-badge active"><i class="bi bi-circle-fill"></i>Active</span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action detail" title="Detail"
                                                onclick="
                                                    showDetailModal('Ahmad Suryadi', 'ahmad@email.com')
                                                ">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit"
                                                onclick="showEditModal('Ahmad Suryadi')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action delete" title="Hapus"
                                                onclick="showDeleteModal('Ahmad Suryadi')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-section">
                        <div class="pagination-info">Menampilkan 1-5 dari 12 data</div>
                        <div class="pagination">
                            <button class="page-btn" disabled>
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>


    <!-- Add User Modal -->
    <div class="user-modal" id="addUserModal">
        <div class="user-modal-content">
            <div class="user-modal-header">
                <h3><i class="bi bi-person-plus add-icon"></i>Tambah User Baru</h3>
                <button class="btn-close-modal" onclick="hideAddModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="user-modal-body">
                <div class="form-group">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" class="form-control-custom" placeholder="Masukkan nama lengkap" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Username <span class="required">*</span></label>
                        <input type="text" class="form-control-custom" placeholder="Masukkan username" />
                    </div>
                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" class="form-control-custom" placeholder="Masukkan email" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" class="form-control-custom" placeholder="Masukkan password" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password <span class="required">*</span></label>
                        <input type="password" class="form-control-custom" placeholder="Konfirmasi password" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Role <span class="required">*</span></label>
                    <select class="form-control-custom">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-switch-group">
                        <span>Status Aktif</span>
                        <label class="form-switch">
                            <input type="checkbox" checked />
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="user-modal-footer">
                <button class="btn-modal cancel" onclick="hideAddModal()">
                    <i class="bi bi-x"></i>Batal
                </button>
                <button class="btn-modal save">
                    <i class="bi bi-check-lg"></i>Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="user-modal" id="editUserModal">
        <div class="user-modal-content">
            <div class="user-modal-header">
                <h3><i class="bi bi-pencil-square edit-icon"></i>Edit User</h3>
                <button class="btn-close-modal" onclick="hideEditModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="user-modal-body">
                <div class="form-group">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" class="form-control-custom" id="editName" value="Ahmad Suryadi" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Username <span class="required">*</span></label>
                        <input type="text" class="form-control-custom" value="ahmad.suryadi" />
                    </div>
                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" class="form-control-custom" value="ahmad@email.com" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control-custom"
                            placeholder="Kosongkan jika tidak diubah" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control-custom" placeholder="Konfirmasi password baru" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Role <span class="required">*</span></label>
                    <select class="form-control-custom">
                        <option value="admin" selected>Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-switch-group">
                        <span>Status Aktif</span>
                        <label class="form-switch">
                            <input type="checkbox" checked />
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="user-modal-footer">
                <button class="btn-modal cancel" onclick="hideEditModal()">
                    <i class="bi bi-x"></i>Batal
                </button>
                <button class="btn-modal save">
                    <i class="bi bi-check-lg"></i>Update
                </button>
            </div>
        </div>
    </div>

    <!-- Detail User Modal -->
    <div class="user-modal detail-modal" id="detailUserModal">
        <div class="user-modal-content">
            <div class="user-modal-header">
                <h3><i class="bi bi-person-badge detail-icon"></i>Detail User</h3>
                <button class="btn-close-modal" onclick="hideDetailModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="user-modal-body">
                <div class="detail-avatar" id="detailAvatar">AS</div>
                <div class="detail-name">
                    <h4 id="detailName">Ahmad Suryadi</h4>
                    <span id="detailEmail">ahmad@email.com</span>
                </div>
                <div class="detail-info-list">
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-person"></i>Username</div>
                        <div class="value">ahmad.suryadi</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-shield-check"></i>Role</div>
                        <div class="value">
                            <span class="role-badge admin">Admin</span>
                        </div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-toggle-on"></i>Status</div>
                        <div class="value">
                            <span class="status-badge active"><i class="bi bi-circle-fill"></i>Active</span>
                        </div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label"><i class="bi bi-calendar3"></i>Bergabung</div>
                        <div class="value">12 Januari 2024</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="label">
                            <i class="bi bi-clock-history"></i>Terakhir Login
                        </div>
                        <div class="value">Hari ini, 10:30</div>
                    </div>
                </div>
            </div>
            <div class="user-modal-footer">
                <button class="btn-modal cancel" onclick="hideDetailModal()">
                    <i class="bi bi-x"></i>Tutup
                </button>
                <button class="btn-modal save"
                    onclick="
              hideDetailModal();
              showEditModal('Ahmad Suryadi');
            ">
                    <i class="bi bi-pencil"></i>Edit User
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="user-modal delete-modal" id="deleteUserModal">
        <div class="user-modal-content">
            <div class="user-modal-body">
                <div class="delete-icon-wrapper"><i class="bi bi-trash3"></i></div>
                <h3>Hapus User?</h3>
                <p>Anda yakin ingin menghapus user ini?</p>
                <div class="user-to-delete" id="userToDelete">Ahmad Suryadi</div>
                <p style="font-size: 0.85rem; color: var(--text-secondary)">
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="modal-buttons">
                    <button class="btn-delete cancel" onclick="hideDeleteModal()">
                        <i class="bi bi-x"></i>Batal
                    </button>
                    <button class="btn-delete confirm">
                        <i class="bi bi-trash"></i>Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>

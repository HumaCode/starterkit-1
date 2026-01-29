// ========== SIDEBAR & HEADER ==========
const sidebar = document.getElementById('sidebar');
const mainHeader = document.getElementById('mainHeader');
const mainContent = document.getElementById('mainContent');
const mainFooter = document.getElementById('mainFooter');
const toggleBtn = document.getElementById('toggleSidebar');
const mobileOverlay = document.getElementById('mobileOverlay');
const floatBtn = document.getElementById('floatBtn');
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');

function isMobile() {
    return window.innerWidth <= 992;
}

toggleBtn.addEventListener('click', function() {
    if (isMobile()) {
        sidebar.classList.toggle('mobile-show');
        mobileOverlay.classList.toggle('show');
    } else {
        sidebar.classList.toggle('collapsed');
        mainHeader.classList.toggle('expanded');
        mainContent.classList.toggle('expanded');
        mainFooter.classList.toggle('expanded');
    }
});

mobileOverlay.addEventListener('click', function() {
    sidebar.classList.remove('mobile-show');
    mobileOverlay.classList.remove('show');
});

// ========== USER DROPDOWN ==========
function toggleUserDropdown() {
    document.getElementById('userDropdown').classList.toggle('show');
}

document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('userDropdown');
    if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('show');
    }
});

// ========== THEME TOGGLE ==========
function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    themeIcon.className = theme === 'dark' ? 'bi bi-moon' : 'bi bi-sun';

    // Update theme radio buttons
    const themeRadios = document.querySelectorAll('input[name="theme"]');
    themeRadios.forEach(function(radio) {
        radio.checked = radio.value === theme;
    });
}

themeToggle.addEventListener('click', function() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    setTheme(currentTheme === 'dark' ? 'light' : 'dark');
});

// Load saved theme
setTheme(localStorage.getItem('theme') || 'light');

// Theme radio buttons
document.querySelectorAll('input[name="theme"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        if (this.value === 'system') {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            setTheme(prefersDark ? 'dark' : 'light');
        } else {
            setTheme(this.value);
        }
    });
});

// ========== FLOATING BUTTON ==========
window.addEventListener('scroll', function() {
    floatBtn.classList.toggle('show', window.scrollY > 300);
});

// ========== SETTINGS NAVIGATION ==========
const settingsNavItems = document.querySelectorAll('.settings-nav-item');
const settingsSections = document.querySelectorAll('.settings-section');

settingsNavItems.forEach(function(item) {
    item.addEventListener('click', function(e) {
        e.preventDefault();

        const targetSection = this.getAttribute('data-section');

        // Update active nav
        settingsNavItems.forEach(function(nav) {
            nav.classList.remove('active');
        });
        this.classList.add('active');

        // Show target section
        settingsSections.forEach(function(section) {
            section.classList.remove('active');
        });
        document.getElementById(targetSection).classList.add('active');

        // Scroll to top on mobile
        if (isMobile()) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
});

// ========== PASSWORD TOGGLE ==========
document.querySelectorAll('.password-toggle').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    });
});

// ========== SHOW TOAST ==========
function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = 'toast-notification ' + type;
    toast.innerHTML = '<i class="bi bi-' + (type === 'success' ? 'check-circle' : 'x-circle') + '"></i> ' + message;
    document.body.appendChild(toast);

    setTimeout(function() {
        toast.classList.add('show');
    }, 10);

    setTimeout(function() {
        toast.classList.remove('show');
        setTimeout(function() {
            toast.remove();
        }, 300);
    }, 3000);
}

// ========== SAVE BUTTONS ==========
document.querySelectorAll('.btn-primary').forEach(function(btn) {
    if (btn.textContent.includes('Simpan')) {
        btn.addEventListener('click', function() {
            showToast('Perubahan berhasil disimpan!', 'success');
        });
    }
});



// Modal Functions
function openModal(id) {
    document.getElementById(id).classList.add('show');
    document.body.style.overflow = 'hidden';
    if (id === 'modalLoading') simulateLoading();
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
    document.body.style.overflow = '';
}

function closeModalOnOverlay(event, id) {
    if (event.target === event.currentTarget) {
        closeModal(id);
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.show').forEach(function(m) {
            m.classList.remove('show');
        });
        document.body.style.overflow = '';
    }
});
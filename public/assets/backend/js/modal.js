// Sidebar
const sidebar = document.getElementById('sidebar');
const mainHeader = document.getElementById('mainHeader');
const mainContent = document.getElementById('mainContent');
const toggleBtn = document.getElementById('toggleSidebar');
const mobileOverlay = document.getElementById('mobileOverlay');
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');

toggleBtn.addEventListener('click', function() {
    if (window.innerWidth <= 992) {
        sidebar.classList.toggle('mobile-show');
        mobileOverlay.classList.toggle('show');
    } else {
        sidebar.classList.toggle('collapsed');
        mainHeader.classList.toggle('expanded');
        mainContent.classList.toggle('expanded');
    }
});

mobileOverlay.addEventListener('click', function() {
    sidebar.classList.remove('mobile-show');
    mobileOverlay.classList.remove('show');
});

function toggleUserDropdown() {
    document.getElementById('userDropdown').classList.toggle('show');
}

document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('userDropdown');
    if (!dropdown.contains(e.target)) dropdown.classList.remove('show');
});

// Theme
function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    themeIcon.className = theme === 'dark' ? 'bi bi-moon' : 'bi bi-sun';
}
themeToggle.addEventListener('click', function() {
    setTheme(document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
});
setTheme(localStorage.getItem('theme') || 'light');

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

// Password Toggle
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

// Rating Stars
const stars = document.querySelectorAll('#ratingStars i');
const ratingText = document.getElementById('ratingText');
const labels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

stars.forEach(function(star) {
    star.addEventListener('click', function() {
        const rating = this.dataset.rating;
        stars.forEach(function(s, i) {
            s.className = i < rating ? 'bi bi-star-fill active' : 'bi bi-star';
        });
        ratingText.textContent = labels[rating];
    });
});

// File Upload
const uploadZone = document.getElementById('uploadZone');
const fileInput = document.getElementById('fileInput');
const fileList = document.getElementById('fileList');
const uploadBtn = document.getElementById('uploadBtn');
let files = [];

uploadZone.addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('dragover'); });
uploadZone.addEventListener('dragleave', function() { this.classList.remove('dragover'); });
uploadZone.addEventListener('drop', function(e) { e.preventDefault(); this.classList.remove('dragover'); addFiles(e.dataTransfer.files); });
fileInput.addEventListener('change', function() { addFiles(this.files); });

function addFiles(newFiles) {
    for (let f of newFiles) {
        if (files.length >= 5) break;
        files.push(f);
        const size = (f.size / 1024 / 1024).toFixed(2);
        const icon = f.type.startsWith('image') ? 'bi-file-image' : f.type === 'application/pdf' ? 'bi-file-pdf' : 'bi-file-earmark';
        fileList.innerHTML += '<div class="file-item"><div class="file-icon"><i class="bi ' + icon + '"></i></div><div class="file-info"><h5>' + f.name + '</h5><p>' + size + ' MB</p></div><button class="file-remove" onclick="removeFile(this,\'' + f.name + '\')"><i class="bi bi-x"></i></button></div>';
    }
    uploadBtn.disabled = files.length === 0;
}

function removeFile(btn, name) {
    files = files.filter(f => f.name !== name);
    btn.parentElement.remove();
    uploadBtn.disabled = files.length === 0;
}

// Loading Simulation
function simulateLoading() {
    const bar = document.getElementById('loadingBar');
    const text = document.getElementById('loadingText');
    let p = 0;
    bar.style.width = '0%';
    text.textContent = '0%';
    const interval = setInterval(function() {
        p += Math.random() * 20;
        if (p >= 100) { p = 100; clearInterval(interval); setTimeout(function() { closeModal('modalLoading'); }, 500); }
        bar.style.width = p + '%';
        text.textContent = Math.round(p) + '%';
    }, 300);
}
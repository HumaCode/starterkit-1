// Initialize AOS
AOS.init({
    once: true,
    easing: "ease-out-cubic",
    duration: 800,
});

// ==================== USER PAGE SCRIPTS ====================

function showAddModal() {
    document.getElementById("addUserModal").classList.add("show");
}

function hideAddModal() {
    document.getElementById("addUserModal").classList.remove("show");
}

function showEditModal(name) {
    document.getElementById("editName").value = name;
    document.getElementById("editUserModal").classList.add("show");
}

function hideEditModal() {
    document.getElementById("editUserModal").classList.remove("show");
}

function showDetailModal(name, email) {
    const initials = name
        .split(" ")
        .map((n) => n[0])
        .join("")
        .toUpperCase();
    document.getElementById("detailAvatar").textContent = initials;
    document.getElementById("detailName").textContent = name;
    document.getElementById("detailEmail").textContent = email;
    document.getElementById("detailUserModal").classList.add("show");
}

function hideDetailModal() {
    document.getElementById("detailUserModal").classList.remove("show");
}

function showDeleteModal(name) {
    document.getElementById("userToDelete").textContent = name;
    document.getElementById("deleteUserModal").classList.add("show");
}

function hideDeleteModal() {
    document.getElementById("deleteUserModal").classList.remove("show");
}

document.querySelectorAll(".user-modal").forEach((modal) => {
    modal.addEventListener("click", (e) => {
        if (e.target === modal) modal.classList.remove("show");
    });
});

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        document
            .querySelectorAll(".user-modal.show")
            .forEach((modal) => modal.classList.remove("show"));
        document
            .querySelectorAll(".custom-select.open")
            .forEach((select) => select.classList.remove("open"));
        hideLogoutModal();
    }
});

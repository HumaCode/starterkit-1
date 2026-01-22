// Initialize AOS
AOS.init({
    once: true,
    easing: "ease-out-cubic",
});

// Toggle Password Visibility
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
    }
}

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

// Add ripple effect on button click
document.querySelector(".btn-login").addEventListener("click", function (e) {
    const rect = this.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const ripple = document.createElement("span");
    ripple.style.cssText = `
                position: absolute;
                background: rgba(255, 255, 255, 0.4);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
                left: ${x}px;
                top: ${y}px;
                width: 100px;
                height: 100px;
                margin-left: -50px;
                margin-top: -50px;
            `;

    this.style.position = "relative";
    this.style.overflow = "hidden";
    this.appendChild(ripple);

    setTimeout(() => ripple.remove(), 600);
});

// Add ripple animation keyframes
const style = document.createElement("style");
style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
document.head.appendChild(style);

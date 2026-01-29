// Chart.js Configuration
const chartColors = {
    light: {
        text: "#4a5568",
        grid: "#e8ecf0",
        primary: "rgba(168, 213, 229, 1)",
        secondary: "rgba(245, 213, 224, 1)",
        purple: "rgba(224, 212, 245, 1)",
        accent: "rgba(212, 229, 215, 1)",
        peach: "rgba(252, 228, 216, 1)",
    },
    dark: {
        text: "#e2e8f0",
        grid: "#4a5568",
        primary: "rgba(168, 213, 229, 0.8)",
        secondary: "rgba(245, 213, 224, 0.8)",
        purple: "rgba(224, 212, 245, 0.8)",
        accent: "rgba(212, 229, 215, 0.8)",
        peach: "rgba(252, 228, 216, 0.8)",
    },
};

function getChartColors() {
    const theme = document.documentElement.getAttribute("data-theme");
    return chartColors[theme] || chartColors.light;
}

// Sales Line Chart
const salesCtx = document.getElementById("salesChart").getContext("2d");
const salesChart = new Chart(salesCtx, {
    type: "line",
    data: {
        labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
        datasets: [
            {
                label: "Penjualan",
                data: [12, 19, 15, 25, 22, 30, 28],
                borderColor: getChartColors().primary,
                backgroundColor: "rgba(168, 213, 229, 0.1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#fff",
                pointBorderColor: getChartColors().primary,
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 8,
            },
            {
                label: "Pesanan",
                data: [8, 15, 12, 20, 18, 25, 22],
                borderColor: getChartColors().purple,
                backgroundColor: "rgba(224, 212, 245, 0.1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#fff",
                pointBorderColor: getChartColors().purple,
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 8,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: "top",
                labels: {
                    color: getChartColors().text,
                    usePointStyle: true,
                    padding: 20,
                },
            },
        },
        scales: {
            x: {
                grid: {
                    display: false,
                },
                ticks: {
                    color: getChartColors().text,
                },
            },
            y: {
                grid: {
                    color: getChartColors().grid,
                },
                ticks: {
                    color: getChartColors().text,
                },
            },
        },
    },
});

// Category Doughnut Chart
const categoryCtx = document.getElementById("categoryChart").getContext("2d");
const categoryChart = new Chart(categoryCtx, {
    type: "doughnut",
    data: {
        labels: ["Elektronik", "Fashion", "Makanan", "Kesehatan", "Lainnya"],
        datasets: [
            {
                data: [35, 25, 20, 12, 8],
                backgroundColor: [
                    getChartColors().primary,
                    getChartColors().secondary,
                    getChartColors().purple,
                    getChartColors().accent,
                    getChartColors().peach,
                ],
                borderWidth: 0,
                hoverOffset: 10,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    color: getChartColors().text,
                    usePointStyle: true,
                    padding: 15,
                },
            },
        },
        cutout: "65%",
    },
});

// Bar Chart
const barCtx = document.getElementById("barChart").getContext("2d");
const barChart = new Chart(barCtx, {
    type: "bar",
    data: {
        labels: ["Elektronik", "Fashion", "Makanan", "Kesehatan"],
        datasets: [
            {
                label: "Penjualan (juta)",
                data: [45, 32, 28, 15],
                backgroundColor: [
                    getChartColors().primary,
                    getChartColors().secondary,
                    getChartColors().purple,
                    getChartColors().accent,
                ],
                borderRadius: 8,
                borderSkipped: false,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                grid: {
                    display: false,
                },
                ticks: {
                    color: getChartColors().text,
                },
            },
            y: {
                grid: {
                    color: getChartColors().grid,
                },
                ticks: {
                    color: getChartColors().text,
                },
            },
        },
    },
});

// Update Charts Theme
function updateChartsTheme() {
    const colors = getChartColors();

    // Update Sales Chart
    salesChart.data.datasets[0].borderColor = colors.primary;
    salesChart.data.datasets[0].pointBorderColor = colors.primary;
    salesChart.data.datasets[1].borderColor = colors.purple;
    salesChart.data.datasets[1].pointBorderColor = colors.purple;
    salesChart.options.plugins.legend.labels.color = colors.text;
    salesChart.options.scales.x.ticks.color = colors.text;
    salesChart.options.scales.y.ticks.color = colors.text;
    salesChart.options.scales.y.grid.color = colors.grid;
    salesChart.update();

    // Update Category Chart
    categoryChart.data.datasets[0].backgroundColor = [
        colors.primary,
        colors.secondary,
        colors.purple,
        colors.accent,
        colors.peach,
    ];
    categoryChart.options.plugins.legend.labels.color = colors.text;
    categoryChart.update();

    // Update Bar Chart
    barChart.data.datasets[0].backgroundColor = [
        colors.primary,
        colors.secondary,
        colors.purple,
        colors.accent,
    ];
    barChart.options.scales.x.ticks.color = colors.text;
    barChart.options.scales.y.ticks.color = colors.text;
    barChart.options.scales.y.grid.color = colors.grid;
    barChart.update();
}

// Filter buttons functionality
document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        this.parentElement
            .querySelectorAll(".filter-btn")
            .forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
    });
});

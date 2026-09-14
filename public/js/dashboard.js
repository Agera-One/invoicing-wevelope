(function () {
  const data = window.dashboardData || {};

  const trendLabels = data.trendLabels || [];
  const trendValues = data.trendValues || [];
  const unpaidTrendValues = data.unpaidTrendValues || [];
  const ooData = data.ooData || [];
  const ooColors = data.ooColors || [];

  // ----- Revenue Trend chart -----
  const trendCtx = document.getElementById("revenueTrendChart");
  if (trendCtx) {
    const revenueGradient = trendCtx
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 220);
    revenueGradient.addColorStop(0, "rgba(45, 212, 64, 0.48)");
    revenueGradient.addColorStop(1, "rgba(45, 212, 120, 0.16)");

    const unpaidGradient = trendCtx
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 220);
    unpaidGradient.addColorStop(0, "rgba(255, 193, 7, 0.35)");
    unpaidGradient.addColorStop(1, "rgba(255, 193, 7, 0.05)");

    new Chart(trendCtx, {
      type: "line",
      data: {
        labels: trendLabels,
        datasets: [
          {
            label: "Revenue",
            data: trendValues,
            borderColor: "#00ff00",
            backgroundColor: revenueGradient,
            fill: true,
            tension: 0.4,
            pointRadius: 3,
            borderWidth: 2,
          },
          {
            label: "Unpaid",
            data: unpaidTrendValues,
            borderColor: "#ffff00",
            backgroundColor: unpaidGradient,
            fill: true,
            tension: 0.4,
            pointRadius: 3,
            borderWidth: 2,
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
            align: "end",
            labels: { boxWidth: 10, boxHeight: 10 },
          },
          tooltip: {
            callbacks: {
              label: (ctx) =>
                ctx.dataset.label +
                ": Rp" +
                ctx.parsed.y.toLocaleString("id-ID"),
            },
          },
        },
        scales: {
          x: { grid: { display: false } },
          y: {
            grid: { color: "rgba(255,255,255,0.06)" },
            ticks: {
              callback: (v) =>
                "Rp" + (v / 1000000).toLocaleString("id-ID") + "M",
            },
          },
        },
      },
    });
  }

  // ----- Outstanding vs Overdue donut chart -----
  const ooCtx = document.getElementById("ooChart");
  if (ooCtx) {
    new Chart(ooCtx, {
      type: "doughnut",
      data: {
        datasets: [
          {
            data: ooData,
            backgroundColor: ooColors,
            borderWidth: 0,
          },
        ],
      },
      options: {
        cutout: "65%",
        plugins: { legend: { display: false } },
      },
    });
  }
})();

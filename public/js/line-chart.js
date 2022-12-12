
const ctx = document.getElementById('line-chartcanvas');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'All Investements',
            data: [12, 59, 33, 85, 22, 43, 98, 56, 80, 50, 34, 99],
            borderColor: '#0d6efd',
            backgroundColor: '#0d6efd1a',
            borderWidth: 2,
            tension: 0.4,
            fill: true,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                grid: {
                    drawBorder: true,
                    display: false,
                }
            },
            y: {
                beginAtZero: false,
                grid: {
                    drawBorder: false,
                    display: true,
                }
            }
        }
    }
});

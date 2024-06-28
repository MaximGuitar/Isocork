import Chart from 'chart.js/auto';
const ctx = document.getElementById('myChart');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
        datasets: [
          {
            label: 'Dataset 1',
            data: [10, 45, 27, 12, 6],
    
          }
        ]
      },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },

      }
    },
    
});





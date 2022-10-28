$('.counter-up').counterUp({
    delay: 10,
    time: 1000
});

let dateArr = ['jul 21', 'jul 28', 'jul 10', 'jul 19', 'jul 13', 'jul 22', 'jul 30', 'jul 5', 'jul 1', 'jul 27', 'jul 31'];
let orderCountArr = [7, 5, 6, 3, 5, 6, 22, 4, 66, 12, 4];
let viewerCountArr = [13, 10, 22, 16, 6, 18, 11, 10, 21, 20, 9];
const ctx = document.getElementById('ov').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: dateArr,
        data: orderCountArr,
        datasets: [{
            label: 'Order count',
            data: orderCountArr,
            backgroundColor: [
                '#28c7fa',
            ],
            borderColor: [
                '#007bff',
            ],
            tension: 0,
            borderWidth: 1
        },
            {
                label: 'Viewer count',
                data: viewerCountArr,
                backgroundColor: [
                    ': #28a745',
                ],
                borderColor: [
                    ': #28a74590',
                ],
                tension: 0,
                borderWidth: 1
            }]
    },
    options: {
        scales: {
            y: [{
                display: false,
                beginAtZero: true,
            }],

            x: [{
                display: false,
                gridLines: {
                    drawBorder: false,
                },
            }]
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: '#333',
                usePointStyle: true,
            }
        }

    }
});

let orderFromPlace = [5, 15, 4, 9, 7];
let place = ["YGN", "MDY", "NPT", "SHAN", "MGW"];
var ctx1 = document.getElementById('op').getContext('2d');
var myChart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: place,
        datasets: [{
            label: place,
            data: orderFromPlace,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: [{
                beginAtZero: true,
                display: false,
            },
            ]
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                fontColor: '#333',
                usePointStyle: true,
            }
        }
    }
});

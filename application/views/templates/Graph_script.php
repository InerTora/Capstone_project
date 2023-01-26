<!-- <script src="<?php echo base_url('includes/static/js/script.js'); ?>"></script> -->

<script type="text/javascript">
var ctx = document.getElementById('chartjs-dashboard-bar').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'Payables',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [3500, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120]
            },
            {
                label: 'Paid Accounts',
                backgroundColor: 'rgb(54, 162, 235)',
                borderColor: 'rgb(54, 162, 235)',
                data: [1500, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 120]
            }
        ]
    },

    // Configuration options go here
    options: {}
});
</script>

<!-- <script>
// Bar chart
document.addEventListener("DOMContentLoaded", function() {

    new Chart(document.getElementById("chartjs-dashboard-bar"), {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                "Dec"
            ],
            datasets: [{
                label: "Accounts Payable",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: [500, 200, 200, 150, 0, 0, 0, 0, 0, 0, 0, 0],
                barPercentage: .75,
                categoryPercentage: .5
            }],


        },

        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 20
                    }
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
});
</script> -->
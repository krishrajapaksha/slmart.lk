<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>slmart | admin</title>

    <!-- Bootstrap core CSS -->
    <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet">


    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="admin/assets/fontawesome/css/all.min.css">

    <!-- chart Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="admin/assets/css/dashboard.css" rel="stylesheet">

</head>
<body>
    
    @include('admin.header')

    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            @include('admin.body')
            
        </div>
    </div>


    <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="admin/assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>

    <!-- Bar Chart -->


    <script>
        let revenueChart = document.getElementById('revenueChart').getContext('2d');

        let revenueData = {!! json_encode($revenue_by_day) !!};

        let labels = revenueData.map(data => data.date);
        let revenue = revenueData.map(data => data.revenue);

        let barChart = new Chart(revenueChart, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Price',
                    data: revenue,
                    backgroundColor:'#1ba371',
                }]
            },
            options: {
                title:{
                    display:true,
                    text:'Total Revenue By Days',
                    fontFamily: 'Poppins, sans-serif',
                },
                legend:{
                    display:false,
                    position:'right'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontFamily: 'Poppins, sans-serif', 
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontFamily: 'Poppins, sans-serif',
                        }
                    }]
                }
            } 
        });
    </script>

    <!-- Pie Chart -->
    

    <script>
        let orderStatusChart = document.getElementById('orderStatusChart').getContext('2d');

        let percentageData = {
            'Ordered': {{ $percentage_ordered }},
            'Canceled': {{ $percentage_canceled }},
            'Delivered': {{ $percentage_delivered }},
        };

        let labelsPie = Object.keys(percentageData);
        let percentages = Object.values(percentageData);

        let pieChartInstance = new Chart(orderStatusChart, {
            type: 'pie',
            data: {
                labels: labelsPie,
                datasets: [{
                    label: 'Order Status Percentage',
                    data: percentages,
                    backgroundColor: [
                        '#1ba371', // Ordered
                        '#f66d44', // Canceled
                        '#f9c80e', // Delivered
                    ],
                }]
            },
            options: {
                title:{
                    display:true,
                    text:'Order Status Percentage',
                    fontFamily: 'Poppins, sans-serif', 
                },
                legend:{
                    display:true,
                    position:'right'
                }
            } 
        });
    </script>

  </body>
</html>

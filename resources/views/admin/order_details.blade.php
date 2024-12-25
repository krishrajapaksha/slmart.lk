<!doctype html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>slmart | admin</title>

    <!-- Bootstrap core CSS -->
    <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="admin/assets/fontawesome/css/all.min.css">

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

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-body">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Order Details</h1>
                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Order Number</td>
                                <td>{{$order->id}}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$order->name}} {{$order->last_name}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$order->address}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$order->city}}</td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td>{{$order->zip_Code}}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{$order->phone}}</td>
                            </tr>
                            <tr>
                                <td>Grandtotal</td>
                                <td>Rs. {{ number_format($order->grand_total,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>{{$order->payment_status}}</td>
                            </tr>
                            <tr>
                                <td>Delivery Status</td>
                                <td>{{$order->delivery_status}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row">
                <div class="col-md-8">

                    <div class="product-details">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Item</th>
                                    <th scope="col" class="text-center">QTY</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderItems as $orderItem)
                                <tr>
                                    <td class="align-middle">
                                        <img class="prev_image" src="/product/{{$orderItem->image}}">
                                    </td>
                                    <td class="align-middle">{{$orderItem->name}}</td>
                                    <td class="align-middle text-center">{{$orderItem->qty}}</td>
                                    <td class="align-middle text-center">Rs. {{ number_format($orderItem->price,2,'.',',') }}</td>
                                    <td class="align-middle text-center">Rs. {{ number_format($orderItem->total,2,'.',',') }}</td>
                                    
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="{{url('order')}}" class="btn primary-btn">Back to Orders</a></td>

                                </tr>
                            </tbody>
                        </table>
                        
                    </div>

                
                </div>
            </div>   
        </main>
    </div>
</div>
<script src="admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="admin/assets/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>

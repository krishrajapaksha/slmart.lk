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
                    <h1 class="h2">All Orders</h1>
                    <form class="d-flex" action="{{url('search')}}" nethod="get">
                        @csrf
                        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                

                <div class="row">
                    <div class="col-md-12">

                        <div class="product-details">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Order Number</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col">City</th>
                                    <th scope="col" class="text-center">Zip Code</th>
                                    <th scope="col" class="text-center">Phone</th>
                                    <th scope="col" class="text-center">Subtotal</th>
                                    <th scope="col" class="text-center">Shipping fee</th>
                                    <th scope="col" class="text-center">GrandTotal</th>
                                    <th scope="col"class="text-center">Payment Status</th>
                                    <th scope="col" class="text-center">Delivery Status</th>
                                    <th scope="col" class="text-center">Order</th>
                                    <th scope="col" class="text-center">Delivered</th>
                                    <th scope="col" class="text-center">Download</th>
                                    <th scope="col" class="text-center">Send Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse($order as $order)
                                    <tr>
                                        <td class="align-middle">{{$order->id}}</td>
                                        <td class="align-middle">{{$order->email}}</td>
                                        <td class="align-middle">{{$order->city}}</td>
                                        <td class="align-middle">{{$order->zip_Code}}</td>
                                        <td class="align-middle">{{$order->phone}}</td>
                                        <td class="align-middle text-right">Rs. {{ number_format($order->subtotal,2,'.',',') }}</td>
                                        <td class="align-middle text-right">Rs. {{ number_format($order->shipping,2,'.',',') }}</td>
                                        <td class="align-middle text-right">Rs. {{ number_format($order->grand_total,2,'.',',') }}</td>
                                        <td class="text-center align-middle">{{$order->payment_status}}</td>
                                        <td class="align-middle">{{$order->delivery_status}}</td>
                                        <td class="align-middle text-center"><a href="{{url('view_order_details',$order->id)}}" class="btn btn-view">View</a></td>
                                        <td class="align-middle text-center">
                                            @if($order->delivery_status=='Processing')
                                            <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are You Sure this Product is Deliverd?')" class="btn btn-delivered">Delivered</a>
                                            @else
                                            <p>Delivered</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center"><a href="{{url('print_pdf',$order->id)}}" class="btn btn-pdf">PDF</a></td>
                                        <td class="align-middle text-center"><a href="{{url('send_email',$order->id)}}" class="btn btn-pdf"><i class="fa-solid fa-envelope"></i></a></td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td colspan="14" class="align-middle text-center">No Data Found</td>
                                    </tr>

                                    @endforelse
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

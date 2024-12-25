<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/public">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>slmart.lk</title>

  <!--Bootstrap-->
  <link href="home/assets/css/bootstrap.min.css" rel="stylesheet">

  <!--owl-carousel-->
  <link href="home/assets/css/owl.carousel.min.css" rel="stylesheet">
  <link href="home/assets/css/owl.theme.default.min.css" rel="stylesheet">

  <!--Google Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="home/assets/fontawesome/css/all.min.css">

  <!--Custom style sheets-->
  <link href="home/assets/css/styles.css" rel="stylesheet">

</head>

<body>
@include('sweetalert::alert')
  <!--Navbar-->
  @include('home.navigation')
  <!--End Navbar-->

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active">My Orders</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    
    <section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @php $order = $order->reverse(); @endphp

                @if(count($order) > 0) <!-- Check if there are orders available -->
                    @foreach($order as $order)
                        <div class="orderCard">
                            <div class="container-fluid py-5">
                                <span class="orderNum">Order {{$order->id}} </span>
                                <span class="delistat">{{$order->delivery_status}}</span>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" colspan="2">Item</th>
                                            <th scope="col" class="text-center">QTY</th>
                                            <th scope="col" class="text-center">Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderItems as $orderItem)
                                            @if($orderItem->order_id == $order->id) <!-- Check if orderItem belongs to current order -->
                                                <tr>
                                                    <td class="align-middle">
                                                        <img class="prev_image" src="/product/{{$orderItem->image}}" style="width: 50px;">
                                                    </td>
                                                    <td class="align-middle">{{$orderItem->name}}</td>
                                                    <td class="align-middle text-center">{{$orderItem->qty}}</td>
                                                    <td class="align-middle text-center">Rs. {{ number_format($orderItem->total,2,'.',',') }}</td>
                                                    <td class="align-middle text-center">
                                                        @if($order->delivery_status=='Delivered')
                                                            <a class="View-more-btn" href="{{url('rate_review',$orderItem->product_id)}}">Rate this</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="changestatus">
                                    @if($order->delivery_status=='Processing')
                                        <a onclick="return confirm('Are You Sure to Cancel this Order?')" class="View-more-btn" href="{{url('cancel_order',$order->id)}}">Cancel Order</a>
                                    @elseif($order->delivery_status=='Cancelled')
                                        <p style="color:#949494; font-size: 14px;">You Cancelled This Order</p>
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Display "NO ORDERS" message -->
                    <div class="orderCard">
                        <div class="container-fluid py-5">
                            <h5 style="text-align: center;">Your Order List is Empty!</h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Shopping Cart Section End -->



  

  <!-- Footer Section -->
  @include('home.footer') 
  <!-- Footer End -->

  <script src="home/assets/js/bootstrap.bundle.min.js"></script>
  <script src="home/assets/js/jquery-3.7.1.min.js"></script>
  <script src="home/assets/js/owl.carousel.min.js"></script>
  <script src="home/assets/js/main.js"></script>
  

  

</body>

</html>
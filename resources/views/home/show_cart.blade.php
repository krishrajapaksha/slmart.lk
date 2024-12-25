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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                        <li class="active">Cart</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            @if(count($cart) > 0)
            <div class="col-lg-8">
                <div class="shopping-cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Quantity</th>
                                <th class="text-center">Total</th>
                                <th></th>
                            </tr>
                        </thead>

                        <?php $subtotal=0; ?>

                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td>
                                    <div class="product-cart-item-pic">
                                        <img src="/product/{{$item->image}}" alt="item image" style="height: 100px;" >
                                    </div>
                                </td>
                                <td class="product-cart-item">
                                    <div class="product-cart-item-text">
                                        <h6>{{$item->product_name}}</h6>
                                        <h6>Rs. {{ number_format($item->price,2,'.',',') }}</h6>
                                    </div>
                                </td>
                                
                                <!-- HTML -->
                                <td class="text-center">
                                    <div class="input-number" style="width: 65px;">
                                        <input type="number" min="1" value="{{$item->quantity}}" name="qty" class="quantity-update" data-id="{{$item->id}}">
                                    </div>
                                </td>

                                <?php $totalprice = $item->price * $item->quantity ?>
                                <td class="cart-price">Rs. {{ number_format($totalprice,2,'.',',') }}</td>
                                <td><a class="cart-close" onclick="confirmation(event)" href="{{url('/remove_cart',$item->id)}}"><i class="fa-solid fa-xmark"></i></a></td>
                            </tr>

                            <?php $subtotal += $totalprice ?>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Total <span>Rs. {{ number_format($subtotal,2,'.',',') }}</span></li>
                    </ul>
                    <a href="{{url('show_checkout')}}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
            @else
            <div class="orderCard">
                        <div class="container-fluid py-5">
                            <h5 style="text-align: center;">Your Cart is Empty!</h5>
                        </div>
                    </div>
            @endif
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

  <script>
    function confirmation(ev){
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title: "Are You Sure to Remove This Product",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel)=>{
            if(willCancel){
                window.location.href = urlToRedirect;
            }
        });
    }

  </script>

// JavaScript (using jQuery)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.quantity-update').on('change', function() {
            var quantity = $(this).val();
            var id = $(this).data('id');
            updateQuantity(id, quantity);
        });

        function updateQuantity(id, quantity) {
            $.ajax({
                url: '/update_quantity',
                type: 'POST',
                data: {
                    id: id,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Reload the page after successful update
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error response if needed
                }
            });
        }
    });
</script>

<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
</script>
  
  

  

</body>

</html>
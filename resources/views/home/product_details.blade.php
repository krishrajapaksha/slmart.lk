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
                        <li>{{$product->category}}</li>
                        <li class="active">{{$product->name}}</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
        @if(session()->has('message'))

        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span>{{ session()->get('message') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif
            <!-- row -->
            <div class="row">

                <div class="col-md-6">
                    <!-- Product Images -->
                    @if($product->aux_image!=null)
                        <div class="owl-carousel product-view">
                            <div class="item"><img src="product/{{$product->main_image}}" alt=""></div>
                            <div class="item"><img src="product/{{$product->aux_image}}" alt=""></div>
                        </div>
                    @else
                        <div class="owl-carousel product-view">
                            <div class="item"><img src="product/{{$product->main_image}}" alt=""></div>
                        </div>
                    @endif

                
                    
                    <!-- End Product Images -->
                </div>

                <!-- Product Details -->
                <div class="col-md-6 order-details">
                    <div class="product-details">
                        <h2 id="product-name">{{$product->name}}</h2>
                        <div class="rating-container">
                            <div class="rated d-flex">
                                @for($i=1; $i<=$avgRate; $i++)
                                <label class="star-rating-complete" title="{{$i}} stars">{{$i}} stars</label>
                                @endfor
                            </div>
                            
                        </div>

                        <div>
                            @if($product->sale_price!=null)
                            <h3 class="product-price">Rs.{{ number_format($product->sale_price,2,'.',',') }} <del class="product-old-price">Rs.{{ number_format($product->regular_price,2,'.',',') }}</del></h3>
                            @else
                            <h3 class="product-price">Rs.{{ number_format($product->regular_price,2,'.',',') }}</h3>
                            @endif
                            
                            @if($product->stock=="In Stock")
                            <span class="product-available">{{$product->quantity}} In Stock</span>
                            @else
                            <span class="product-notavailable">Out of Stock</span>
                            @endif
                        </div>
                        <p class="text-justify">{{$product->short_description}}</p>

                        <form id="add-to-cart-form" action="{{ url('add_cart', $product->id) }}" method="POST">
                            @csrf
                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number">
                                        <input id="quantity-input" type="number" min="1" value="1" name="qty">
                                    </div>
                                </div>

                                @if($product->quantity > 0)
                                    <input class="add-cart" type="submit" value="ADD TO CART">
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="product-info">
                    <h2 class="product-description">Description</h2>

                    <div class="overflow-auto p-3 bg-body-tertiary"
                        style="max-width: 530px; max-height: 250px; border-radius: 10px; text-align: justify;">
                        {{$product->description}}
                    </div>

        
                    <p class="product-description">Reviews</p>

                    <div class="overflow-auto p-3 bg-body-tertiary"
                        style="max-width: 520px; max-height: 250px; border-radius: 10px; text-align: justify;">
                        @foreach($revrate as $rating)
                            <div class="row">
                                <input type="hidden" name="booking_id" value="{{ $rating->id }}">
                                <div class="col">
                                    <div class="rated">
                                        @for($i=1; $i<=$rating->star_rating; $i++)
                                            <label class="star-rating-complete" title="{{$i}} stars">{{$i}} stars</label>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <p>{{ $rating->comment }}</p>
                                </div>
                            </div>
                            <hr>
                            
                            @endforeach
                    </div>





                    </div>
                </div>
                <!-- End Product Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

  

  <!-- Footer Section -->
  @include('home.footer') 
  <!-- Footer End -->

  <script>
    ducument.addEventListener("DOMContentLoaded", function(event){
      var scrollpos = localStorage.getItem('scrollpos');
      if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
      localStorage.setItem('scrollpos', window.scrollY);
    };
  </script>

  <script src="home/assets/js/bootstrap.bundle.min.js"></script>
  <script src="home/assets/js/jquery-3.7.1.min.js"></script>
  <script src="home/assets/js/owl.carousel.min.js"></script>
  <script src="home/assets/js/main.js"></script>

  <script>
    document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
        var quantityInput = document.getElementById('quantity-input').value;
        var productQuantity = {{ $product->quantity }};

        if (parseInt(quantityInput) > productQuantity) {
            alert('Quantity exceeds available stock');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
 
</body>

</html>
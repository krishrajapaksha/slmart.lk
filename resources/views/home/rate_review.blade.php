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
                        
                        <p class="text-justify">{{$product->short_description}}</p>

                        

                            <form class="py-2 px-4" action="{{url('add_rate_review',$product->id)}}" method="POST" autocomplete="off">
                                @csrf
                                <p class="font-weight-bold ">Review</p>
                                    
                                <input type="hidden" name="booking_id" value="">
                                        
                                <div class="rate">
                                    <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" class="rate" name="rating" value="4"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="rating" value="2">
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                
                                <textarea class="form-control" name="comment" rows="6 " placeholder="Add Comment" maxlength="200"></textarea>
                                <button class="add-cart" style="margin-top: 25px;">Submit</button>

                                
                            </form>


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

  <script src="home/assets/js/bootstrap.bundle.min.js"></script>
  <script src="home/assets/js/jquery-3.7.1.min.js"></script>
  <script src="home/assets/js/owl.carousel.min.js"></script>
  <script src="home/assets/js/main.js"></script>
  
</script>

 
</body>

</html>
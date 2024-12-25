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

  <!--NoUISlider-->
  <link href="home/assets/css/nouislider.css" rel="stylesheet">

</head>

<body>
@include('sweetalert::alert')
  <!--Navbar-->
  @include('home.navigation')
  <!--End Navbar-->

  
  <div class="section">
    <div class="container">
        <div class="row">
            <h2>Shop</h2>
        </div>
    </div>
  </div>



<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop-sidebar">
                    <div class="shop-sidebar-accordion">
                        <div class="accordion" id="accordionExample">
                            <form action="" id="FilterForm" method="GET">
                                @csrf
                                <input type="hidden" name="brands" id="brands" value="{{$q_brands}}">
                                <input type="hidden" name="minprice" id="get_minprice" value="">
                                <input type="hidden" name="maxprice" id="get_maxprice" value="">
                                <input type="hidden" name="sortby" id="hiddenSortby" value="">
                            </form>
                            <div class="filter-container">
                                <span class="filter">Filter</span>
                                <button class="btn btn-clear" onclick="clearFilters()">Clear</button>
                            </div>
                            <ul class="list-unstyled ps-0">
                                <li class="border-top my-3"></li>
                                <li class="mb-1">
                                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#brand-collapse" aria-expanded="false" >
                                    Brands
                                    </button>
                                    <div class="collapse" id="brand-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small filter_details">
                                            @foreach($brands as $brand)
                                            <li>
                                                <input class="ChangeBrand" type="checkbox" id="brand-{{ $brand->id }}" name="brands" value="{{ $brand->id }}" onchange="FilterProductsByBrand(this)" @if(in_array($brand->id,explode(',',$q_brands))) checked="checked" @endif>
                                                <label for="brand-{{ $brand->id }}">
                                                    <span></span>
                                                    {{$brand->brand_name}}
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li class="border-top my-3"></li>
                                <li class="mb-1">
                                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                                    Price range (LKR)
                                    </button>
                                    <div class="collapse" id="orders-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <li>
                                                <div class="ranger">
                                                    <div class="lowhigh">
                                                        <div >Min: <span id="kt_slider_basic_min"></span></div>
                                                        <div >Max: <span id="kt_slider_basic_max"></span></div>
                                                    </div>
                                                    <div id="kt_slider_basic" class="slider"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop-product-option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop-product-option-left">
                                @if ($product->count() > 0)
                                <p>Showing {{ $product->firstItem() }} to {{ $product->lastItem() }} of {{ $product->total() }} results</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop-product-option-right">
                                <p>Sort by Price : </p>
                                <select class="select-option ChangeSortby" name="sortby" id="sortby" style="color: black;">
                                    <option value="-1" {{$sortby==-1? 'selected':'' }}>Select</option>
                                    <option value="1" {{$sortby==1? 'selected':'' }}>Low To High</option>
                                    <option value="2" {{$sortby==2? 'selected':'' }}>High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row" id="getfilterproductajax">
                    @include('home._shop')
                </div>
                

                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-pagination">
                        {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

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
  <script src="home/assets/js/nouislider.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        (function () {
            'use strict'
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })()
  
        $(document).ready(function () {
        var minPrice = parseInt("{{$minPrice}}");
        var maxPrice = parseInt("{{$maxPrice}}");

        var slider = document.querySelector("#kt_slider_basic");
        var valueMin = document.querySelector("#kt_slider_basic_min");
        var valueMax = document.querySelector("#kt_slider_basic_max");

        var startRange = [minPrice, maxPrice];

        noUiSlider.create(slider, {
            start: startRange,
            connect: true,
            range: {
                "min": 1,
                "max": 300000
            }
        });

            slider.noUiSlider.on("update", function (values, handle) {
                var minPrice = values[0];
                var maxPrice = values[1];
                $('#get_minprice').val(minPrice);
                $('#get_maxprice').val(maxPrice);
                $('#kt_slider_basic_min').text(minPrice);
                $('#kt_slider_basic_max').text(maxPrice);
            });

            slider.noUiSlider.on("change", function (values, handle) {
                $("#FilterForm").submit();
            });
        });
    

        function FilterProductsByBrand(brand) {
            var brands = "";
            $("input[name='brands']:checked").each(function(){
                if(brands =="")
                {
                    brands += this.value;
                }
                else
                {
                    brands += "," + this.value;
                }
            });
            $("#brands").val(brands);
            $("#FilterForm").submit();
        }


   
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };


        
        document.querySelector('.btn-clear').addEventListener('click', function() {
        // Reset the form values
        document.querySelector("#brands").value = '';
        document.querySelector("#get_minprice").value = '';
        document.querySelector("#get_maxprice").value = '';
        // Submit the form
        document.querySelector("#FilterForm").submit();
        });

        
        $(document).ready(function() {
            $("#sortby").on("change", function() {
                $("#hiddenSortby").val($(this).val());
                $("#FilterForm").submit();
            });
        });

        $(document).ready(function() {
        // Check local storage for the state of the collapses
        if (localStorage.getItem('brandCollapse') === 'true') {
            $('#brand-collapse').collapse('show');
        }

        if (localStorage.getItem('ordersCollapse') === 'true') {
            $('#orders-collapse').collapse('show');
        }

        // Update local storage when the collapses are toggled
        $('#brand-collapse').on('shown.bs.collapse', function () {
            console.log('Brand collapse shown');
            localStorage.setItem('brandCollapse', 'true');
        }).on('hidden.bs.collapse', function () {
            console.log('Brand collapse hidden');
            localStorage.setItem('brandCollapse', 'false');
        });

        $('#orders-collapse').on('shown.bs.collapse', function () {
            console.log('Orders collapse shown');
            localStorage.setItem('ordersCollapse', 'true');
        }).on('hidden.bs.collapse', function () {
            console.log('Orders collapse hidden');
            localStorage.setItem('ordersCollapse', 'false');
        });
        });
    </script>

 
</body>

</html>
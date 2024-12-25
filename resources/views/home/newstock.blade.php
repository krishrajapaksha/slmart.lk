<section class="new-product-carousel">
    <div class="container">
        <div class="row">
          <div class="col-12">
            
              <h6><i class="fa-solid fa-wand-magic-sparkles icon"></i>New Arrivals</h6>
              <div class="d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Explore New Stock</h5>
                  <div>
                      <a class="View-more-btn" href="{{url('new_arrivals')}}">View More</a>
                      <button class="left-right n-prev"><i class="fa-solid fa-arrow-left"></i></button>
                      <button class="left-right n-next"><i class="fa-solid fa-arrow-right"></i></button>
                  </div>
              </div>
                              
            <div class="col-12">
              <div class="new-product-card owl-carousel">
              @foreach($product as $newproducts)
              @if($newproducts->featured=="New")
              <div class="card">
              <a href="{{url('product_details',$newproducts->id)}}"><img src="product/{{$newproducts->main_image}}" class="card-img-top" alt="Product Image"></a>
                <div class="card-body d-flex flex-column justify-content-between">
                  <p class="product-name">{{$newproducts->name}}</p>
                  <p class="product-price">Rs.{{ number_format($newproducts->regular_price,2,'.',',') }}</p>

                  @if($newproducts->quantity > 0)
                    <span class="product-available" style="color:#1ba371; font-weight:700; font-size:12px;">{{$newproducts->quantity}} In Stock</span>
                  @else
                    <span class="product-notavailable" style="color:#e00038; font-weight:700; font-size:12px;">Out of Stock</span>
                  @endif

                </div>
              </div>
              @endif
              @endforeach
            </div>                
            </div>
        </div>
    </div>

</section>
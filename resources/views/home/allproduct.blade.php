<section class="product-carousel">
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="rowtitle">
              <h6><i class="fa-solid fa-bag-shopping icon"></i>Shop</h6>
              <div class="d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">All Products</h5>
                  <div>
                      <a class="View-more-btn" href="{{url('shop')}}">View More</a>
                      <button class="left-right p-prev"><i class="fa-solid fa-arrow-left"></i></button>
                      <button class="left-right p-next"><i class="fa-solid fa-arrow-right"></i></button>
                  </div>
              </div>
            </div>      
            <div class="col-12">
              <div class="product-card owl-carousel">
                @foreach($product as $products)
                <div class="card">
                  <a href="{{url('product_details',$products->id)}}"><img src="product/{{$products->main_image}}" class="card-img-top" alt="Product Image"></a>
                  <div class="product-label">
                    @if($products->featured=="Sale")
                    <span class="sale">Sale</span>
                    @endif
                    @if($products->featured=="New")
                    <span class="new">NEW</span>
                    @endif
                  </div>
                  <div class="card-body d-flex flex-column justify-content-between">
                    <p class="product-name">{{$products->name}}</p>
                    @if($products->sale_price!=null)
                    <p class="product-price">Rs.{{ number_format($products->sale_price,2,'.',',') }} <del class="product-old-price">Rs.{{ number_format($products->regular_price,2,'.',',') }}</del></p>
                    @else
                    <p class="product-price">Rs.{{ number_format($products->regular_price,2,'.',',') }}</p>
                    @endif

                    @if($products->quantity > 0)
                    <span class="product-available" style="color:#1ba371; font-weight:700; font-size:12px;">{{$products->quantity}} In Stock</span>
                    @else
                    <span class="product-notavailable" style="color:#e00038; font-weight:700; font-size:12px;">Out of Stock</span>
                    @endif

                  </div>
                </div>
                @endforeach  
              </div>                
            </div>
        </div>
    </div>

</section>
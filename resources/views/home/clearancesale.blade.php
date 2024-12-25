<section class="sale-product-carousel">
  <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="rowtitle">
            <h6><i class="fa-solid fa-tags icon"></i>Flash Sale</h6>
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Clearance Sale</h5>
                <div>
                    <a class="View-more-btn" href="{{url('sale_products')}}">View More</a>
                    <button class="left-right s-prev"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="left-right s-next"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
          </div>        
          <div class="col-12">
            <div class="sale-product-card owl-carousel">
            @foreach($product as $saleproducts)
              @if($saleproducts->featured=="Sale")
              <div class="card">
              <a href="{{url('product_details',$saleproducts->id)}}"><img src="product/{{$saleproducts->main_image}}" class="card-img-top" alt="Product Image"></a>
                <div class="card-body d-flex flex-column justify-content-between">
                  <p class="product-name">{{$saleproducts->name}}</p>
                  <p class="product-price">Rs.{{ number_format($saleproducts->sale_price,2,'.',',') }} <del class="product-old-price">Rs.{{ number_format($saleproducts->regular_price,2,'.',',') }}</del></p>
                  
                  @if($saleproducts->quantity > 0)
                    <span class="product-available" style="color:#1ba371; font-weight:700; font-size:12px;">{{$saleproducts->quantity}} In Stock</span>
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
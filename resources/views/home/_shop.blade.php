
                    @foreach($product as $products)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                    
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
                                 
                    </div>
                    @endforeach

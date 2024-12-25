<section class="hero-carousel">
    <div class="hero-slider owl-carousel">
        @foreach($slider as $slider)
        <div class="hero-items set-bg" style="background: url(sliders/{{$slider->image}});" id="slider-1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero-text">
                          <h6><i class="fa-solid fa-umbrella-beach icon"></i>{{$slider->sale_type}}</h6>
                          <h3>{{$slider->brand}}</h3>
                          <h1>{{$slider->product_name}}</h1>
                          <a href="{{url('product_details',$slider->product_id)}}" class="primary-btn">Shop now<i class="fa-solid fa-arrow-right btn-icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section> 
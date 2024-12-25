<section class="category-carousel">
      <div class="container">
          <div class="row">
            <div class="col-12">
              <h6><i class="fa-solid fa-layer-group icon"></i>Categories</h6>
              <div class="d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Browse by Category</h5>
                  <div>
                      <button class="left-right prev"><i class="fa-solid fa-arrow-left"></i></button>
                      <button class="left-right next"><i class="fa-solid fa-arrow-right"></i></button>
                  </div>
              </div> 
              <div class="col-12">
                <div class="category-card owl-carousel">
                @foreach($category as $category)
                
                  <div class="card_box">
                    <a href="{{url('category_products',$category->id)}}"><img class="img-fluid category-icon" src="category_icon/{{$category->icon}}" alt=""></a>
                    <div class="card_text">{{$category->category_name}}</div>
                  </div>
                
                @endforeach
              </div>
          </div>
      </div>
  
</section>
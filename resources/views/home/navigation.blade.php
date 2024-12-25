<?php
$current_page = basename($_SERVER['REQUEST_URI']);

// Function to determine if a link should be active
function isActive($page_name, $current_page) {
    if ($page_name === $current_page) {
        return "active";
    } else {
        return "";
    }
}
?>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container navbar-container">
      <a class="navbar-brand me-auto" href="{{url('/')}}"><img src="home/assets/icon/logo.svg"></a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <a href="{{url('show_cart')}}" class="cart-button"><img src="home/assets/icon/cart.svg"></a>
          <a href="#" class="profile-button"><img src="home/assets/icon/Profile.svg"></a>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-2" aria-current="page" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2 <?php echo isActive('sale_products', $current_page); ?>" href="{{url('sale_products')}}">Flash Sale</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2 <?php echo isActive('shop', $current_page); ?>" href="{{url('shop')}}">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2 <?php echo isActive('new_arrivals', $current_page); ?>" href="{{url('new_arrivals')}}">New Arrivals</a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link mx-lg-2 dropdown-toggle" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Category
              </a>
              <ul class="dropdown-menu">
              @isset($category) <!-- Check if $category is set -->
                  @foreach($category as $cat) <!-- Rename the loop variable to avoid conflict -->
                      <li><a class="dropdown-item" href="{{ url('category_products', $cat->id) }}">{{ $cat->category_name }}</a></li>
                  @endforeach
              @endisset
              </ul>
            </li>

          </ul>
        </div>
      </div>
      <div class="search-container">
        <form action="{{url('product_search')}}" method="GET">
          @csrf
          <input class="search expandright" id="searchright" type="search" name="q" placeholder="Search">
          <label class="button searchbutton" for="searchright"><img src="home/assets/icon/Search.svg"></label>
        </form>
      </div>

      @if (Route::has('login'))

      @auth

            <div>
              <a href="{{url('show_cart')}}" class="cart-button mx-lg-2"><img src="home/assets/icon/cart.svg"></a>
              <div class="qty">{{App\Models\cart::where('user_id','=',Auth::user()->id)->count()}}</div>
            </div>
      

            <div class="d-none nav-icons d-lg-block">
              
              <div class="profile-dropdown">
                  <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="home/assets/icon/Profile.svg" alt="" width="30" height="30" class="rounded-circle me-2">
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{url('show_order')}}">My Orders</a></li>
                    <li><a class="dropdown-item" href="{{url('show_address')}}">My Address</a></li>
                    
                    <li><hr class="dropdown-divider"></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li><a style="cursor: pointer;" class="dropdown-item" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
                    </form>
                  </ul>
              </div>
                
              
            </div>
       @else

       <div>
              <a href="{{url('show_cart')}}" class="cart-button mx-lg-2"><img src="home/assets/icon/cart.svg"></a>
              
        </div>
                
                  
       <a  href="{{ route('login') }}" class="login-btn">Login</a>

       @endauth

      @endif

      <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>


  
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

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo isActive('redirect', $current_page); ?>" href="{{url('/redirect')}}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

          <li class="nav-item">
            <a class="nav-link <?php echo isActive('home_slider', $current_page); ?> " href="{{url('home_slider')}}">
              Add Home Slider
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo isActive('order', $current_page); ?> " href="{{url('order')}}">
              Orders
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link  <?php echo isActive('view_product', $current_page); ?>" href="{{url('view_product')}}">
              Add Products
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo isActive('show_product', $current_page); ?>" href="{{url('show_product')}}">
              Show Products
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link <?php echo isActive('view_category', $current_page); ?>" href="{{url('view_category')}}">
              Category
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo isActive('brand_supplier', $current_page); ?>" href="{{url('brand_supplier')}}">
              Brand & Supplier
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo isActive('hot_deal', $current_page); ?>" href="{{url('hot_deal')}}">
              Add Hot Deal
            </a>
          </li>
          
        </ul>
    </div>
</nav>



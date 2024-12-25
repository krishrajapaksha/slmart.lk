///Index Page///

$(document).ready(function(){
    $(".hero-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        nav: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1000,
        autoHeight: false,
        autoplay: true
    });

    //product image//
    $(document).ready(function () {
        $(".product-view").owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa-solid fa-arrow-left"></i>',
                '<i class="fa-solid fa-arrow-right"></i>'
            ],
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            smartSpeed: 1000,
            autoHeight: false,
            autoplay: false
        });
    });
    ////////

    $(document).ready(function(){
      $('.category-card').owlCarousel({
          loop:true,
          margin:10,
          nav:false,
          autoplay: true,
          smartSpeed: 1000,
          responsive:{
          0:{
              items:2
          },
          600:{
              items:4
          },
          1000:{
              items:6
          }
    }
      });

      // Custom navigation buttons
      $('.prev').click(function(){
          $('.category-card').trigger('prev.owl.carousel');
      });

      $('.next').click(function(){
          $('.category-card').trigger('next.owl.carousel');
      });
    });

    //////product

    $(document).ready(function(){
      $('.product-card').owlCarousel({
          loop:true,
          margin:10,
          nav:false,
          responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
    }
      });

      // Custom navigation buttons
      $('.p-prev').click(function(){
          $('.product-card').trigger('prev.owl.carousel');
      });

      $('.p-next').click(function(){
          $('.product-card').trigger('next.owl.carousel');
      });
    });

    ////new stock
    $(document).ready(function(){
      $('.new-product-card').owlCarousel({
          loop:true,
          margin:10,
          nav:false,
          responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
    }
      });

      // Custom navigation buttons
      $('.n-prev').click(function(){
          $('.new-product-card').trigger('prev.owl.carousel');
      });

      $('.n-next').click(function(){
          $('.new-product-card').trigger('next.owl.carousel');
      });
    });

    ///////sale

    $(document).ready(function(){
      $('.sale-product-card').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
      });

      // Custom navigation buttons
      $('.s-prev').click(function(){
          $('.sale-product-card').trigger('prev.owl.carousel');
      });

      $('.s-next').click(function(){
          $('.sale-product-card').trigger('next.owl.carousel');
      });
    });

  ////countdown/////////
  // Set the date we're counting down to
  


});

// JavaScript to hide nav-item when search is expanded
document.addEventListener("DOMContentLoaded", function () {
    var searchInput = document.getElementById('searchright');
    searchInput.addEventListener('focus', function () {
      document.querySelectorAll('.navbar-nav .nav-item').forEach(function (item) {
        item.style.display = 'none';
      });
    });

    searchInput.addEventListener('blur', function () {
      document.querySelectorAll('.navbar-nav .nav-item').forEach(function (item) {
        item.style.display = '';
      });
    });
});

/*-------------------
		Quantity change 
--------------------- */

// cart

    var proQty = $('.pro-qty');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    

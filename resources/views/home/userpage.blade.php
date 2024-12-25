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

</head>

<body>

  @include('sweetalert::alert')

  <!--Navbar-->
  @include('home.navigation')
  <!--End Navbar-->

  <!--Hero Section-->
  @include('home.hero') 
  <!--End Hero Section-->

  <!--category section-->
  @include('home.category') 
  <!--End category section-->

  <!-- HOT DEAL SECTION -->
  @include('home.hotdeals') 
  <!-- /HOT DEAL SECTION -->

  <!--New Stock-->
  @include('home.newstock') 
  <!--End new stock-->


  <!--Clearance sale-->
  @include('home.clearancesale')   
  <!--End Clearance sale-->


  <!--All products-->
  @include('home.allproduct') 
  <!--End Product-->

  <!-- Footer Section -->
  @include('home.footer') 
  <!-- Footer End -->


  <script src="home/assets/js/bootstrap.bundle.min.js"></script>
  <script src="home/assets/js/jquery-3.7.1.min.js"></script>
  <script src="home/assets/js/owl.carousel.min.js"></script>
  <script src="home/assets/js/main.js"></script>

  <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };

    </script>
    

  
 
</body>

</html>
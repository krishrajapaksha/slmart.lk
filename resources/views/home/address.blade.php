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

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active">My Address</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    
    <section>
    <div class="container">
        <div class="row">
        @if(session()->has('message'))

        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span>{{ session()->get('message') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif
        
            <div class="col-lg-10" style="margin: auto;">
                <div class="orderCard">
                    <div class="container-fluid">
                    @if(count($customerAddress) > 0)
                        @foreach($customerAddress as $customer)
                        <form id="editForm{{$customer->id}}" action="{{url('edit_address',$customer->id)}}" method="GET">
                            @csrf
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="align-middle">First Name</td>
                                        <td><input class="input-address" type="text" name="name" value="{{$customer->name}}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Last Name</td>
                                        <td><input class="input-address" type="text" name="lname" value="{{$customer->last_name}}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Address</td>
                                        <td><input class="input-address" type="text" name="address" value="{{$customer->address}}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">City</td>
                                        <td><input class="input-address" type="text" name="city" value="{{$customer->city}}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Zip Code</td>
                                        <td><input class="input-address" type="text" name="zipCode" value="{{$customer->zip_Code}}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Phone</td>
                                        <td><input class="input-address" type="text" name="phone" value="{{$customer->phone}}" readonly></td>
                                        <td class="justify-right">
                                            <button type="button" class="btn primary-btn editBtn" data-id="{{$customer->id}}">Edit</button>
                                        </td>
                                        <td class="justify-right">
                                            <button type="submit" class="btn primary-btn doneBtn" style="display:none;">Done</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        @endforeach
                    @else
                    <form id="addressform" action="{{url('save_address')}}" method="GET">
                            @csrf
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="align-middle">First Name</td>
                                        <td><input class="input-address" type="text" name="name" value="" required></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Last Name</td>
                                        <td><input class="input-address" type="text" name="lname" value="" required></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Address</td>
                                        <td><input class="input-address" type="text" name="address" value="" required></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">City</td>
                                        <td><input class="input-address" type="text" name="city" value="" required></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Zip Code</td>
                                        <td><input class="input-address" type="text" name="zipCode" value="" required></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Phone</td>
                                        <td><input class="input-address" type="text" name="phone" value="" required></td>
                
                                        <td class="justify-right">
                                            <button type="submit" class="btn primary-btn">Save</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- address Section End -->



  

  <!-- Footer Section -->
  @include('home.footer') 
  <!-- Footer End -->

  <script src="home/assets/js/bootstrap.bundle.min.js"></script>
  <script src="home/assets/js/jquery-3.7.1.min.js"></script>
  <script src="home/assets/js/owl.carousel.min.js"></script>
  <script src="home/assets/js/main.js"></script>

  <script>
    
    // Add event listener to all edit buttons
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            const formId = 'editForm' + this.getAttribute('data-id');
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                input.removeAttribute('readonly');
            });
            // Hide Edit button and show Done button
            this.style.display = 'none';
            form.querySelector('.doneBtn').style.display = 'inline-block';
        });
    });

  </script>
  

  

</body>

</html>
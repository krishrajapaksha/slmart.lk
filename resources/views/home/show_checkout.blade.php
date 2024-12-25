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
                <h5 class="breadcrumb-header">Checkout</h5>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
        <!-- /row -->

        @if(session()->has('message'))

        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span>{{ session()->get('message') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif
    </div>
    <!-- /container -->

</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <form id="orderform" name="orderform" action="{{url('place_order')}}" method="POST">
        @csrf
        <!-- row -->
        <div class="row">
            
            
            <div class="col-md-7">
               
                
                <!-- Shiping Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h4 class="title"><i class="fa-solid fa-address-card icon-color"></i>Shiping Address</h4>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="firstname" placeholder="First Name" value="{{ (!empty($customerAddress)) ? $customerAddress->name : '' }}" required>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="lastname" placeholder="Last Name" value="{{ (!empty($customerAddress)) ? $customerAddress->last_name : '' }}" required>
                    </div> 
                    <div class="form-group">
                        <input class="input" type="text" name="address" placeholder="Address" value="{{ (!empty($customerAddress)) ? $customerAddress->address : '' }}" required>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="city" placeholder="City" value="{{ (!empty($customerAddress)) ? $customerAddress->city : '' }}" required>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="zipcode" placeholder="ZIP Code" value="{{ (!empty($customerAddress)) ? $customerAddress->zip_Code : '' }}" required>
                    </div>
                    <div class="form-group">
                        <input class="input" type="tel" name="tel" placeholder="Telephone" value="{{ (!empty($customerAddress)) ? $customerAddress->phone : '' }}" required>
                    </div>
                </div>
                <!-- /Shiping Details -->
                

            </div>

            <!-- Order Details -->
            
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h4 class="title">Order Details</h4>
                </div>
                
                <table class="table billItem-table">
                    <thead>
                      <tr>
                        <th class="justify-left">Item</th>
                        <th class="justify-center">Qty</th>
                        <th class="justify-right">Price</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $subtotal=0; ?>
                    @foreach($cart as $cart)
                      <tr>
                        <td class="justify-left">{{$cart->product_name}}</td>
                        <td class="justify-center">{{$cart->quantity}}</td>
                        <?php $totalprice=0; ?>
                        <?php $totalprice=$cart->price*$cart->quantity; ?>
                        <td class="justify-right">Rs. {{ number_format($totalprice,2,'.',',') }}</td>
                      </tr>
                    </tbody>
                    <?php $subtotal=$subtotal+$totalprice; ?>
                    @endforeach
                    <tfoot>
                      <tr>
                        <td colspan="2" class="justify-left">Shipping Fee</td>
                        <?php $grandtotal=0; ?>
                        <?php $shippingfee=0; ?>
                        @if($subtotal >= 10000)
                            <td class="justify-right">Free</td>
                            <?php $shippingfee=0; ?>                       
                        @elseif($subtotal > 0 && $subtotal < 10000 )
                            <td class="justify-right">Rs. 500</td>
                            <?php $shippingfee=500; ?>
                        @else
                            <td class="justify-right">0</td>
                            <?php $shippingfee=0; ?>
                        @endif

                        <?php $grandtotal=$subtotal+$shippingfee; ?>

                      </tr>
                      <tr>
                        <td colspan="2" class="total-text justify-left">Total Price</td>
                        <td class="total-price justify-right">Rs. {{ number_format($grandtotal,2,'.',',') }}</td> 
                      </tr>
                    </tfoot>
                </table>

                <div class="payment-method">
                    <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1" value="Bank Deposit" >
                                <label for="payment-1">
                                    <span></span>
                                    Bank Deposit
                                </label>
                                <div class="caption">
                                    <p>Once you've placed your order, we'll send you an order number and our bank details via email. Simply deposit the total order amount using the provided order number as a reference. Then, send us the payment receipt as a reply email. Once confirmed, we'll deliver your order within three working days.</p>
                                </div>
                    </div>
                    <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2" value="Cash on Delivery">
                                <label for="payment-2">
                                    <span></span>
                                    Cash on Delivery
                                </label>
                                <div class="caption">
                                    <p>Choose cash on delivery for your order and pay in cash when it arrives. Please note, there will be an additional charge included in the bill for this payment method.</p>
                                </div>
                    </div>
                </div>

                <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                <input type="hidden" name="shippinfee" value="<?php echo $shippingfee; ?>">
                <input type="hidden" name="grandtotal" value="<?php echo $grandtotal; ?>">

                <div id="payment-error" style="color: red; font-size: 14px;"></div>

                <button type="button" class="primary-btn order-submit" onclick="validatePayment()">Place order</button>
                 
            </div>
            <!-- /Order Details -->
        
        </div>
        <!-- /row -->
        </form>
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->  

  <!-- Footer Section -->
  @include('home.footer') 
  <!-- Footer End -->

    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };

        function validatePayment() {
            // Check if either radio button is checked
            if (!document.getElementById('payment-1').checked && !document.getElementById('payment-2').checked) {
                // Display error message
                document.getElementById('payment-error').innerText = "Please select a payment method.";
                return false;
            }
            // Clear error message if payment method is selected
            document.getElementById('payment-error').innerText = "";
            // Submit the form
            document.getElementById("orderform").submit();
            return true;
        }
    
    </script>

  <script src="home/assets/js/bootstrap.bundle.min.js"></script>
  <script src="home/assets/js/jquery-3.7.1.min.js"></script>
  <script src="home/assets/js/owl.carousel.min.js"></script>
  <script src="home/assets/js/main.js"></script>

</body>

</html>
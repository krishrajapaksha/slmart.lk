<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>slmart.lk | Login</title>

  <!--Bootstrap-->
  <link href="home/assets/css/bootstrap.min.css" rel="stylesheet">

  <!--Google Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="home/assets/fontawesome/css/all.min.css">

  <!--Custom style sheets-->
  <link href="home/assets/css/styles.css" rel="stylesheet">

  <style>
        .form-control {
            border: 1px solid #E4E7ED;
            background-color: #FFF;
            border-radius: 10px;
        }

        .form-control:focus {
           
            border: 2px solid #80b6a2;
            box-shadow: none;
            outline: 0;
        }

        

    </style>

</head>
<body>
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="loging-details">
                        <div class="logo text-center mb-3">
                            <a href="{{url('/')}}">
                                <img src="home/assets/icon/logo.svg" alt="slmart Logo" width="175" height="57">
                            </a>
                        </div>
                        <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign in to your account</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control input" name="email" id="email" placeholder="name@example.com" required>
                                <label for="email" class="form-label">Email</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control input" name="password" id="password" value="" placeholder="Password" required>
                                <label for="password" class="form-label">Password</label>
                            </div>

                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-between">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember">
                                    <label class="form-check-label text-secondary" for="remember_me">
                                    Remember me
                                    </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link text-decoration-none">Forgot password?</a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-grid my-3">
                                <button class="primary-btn" type="submit">Log in</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-0 text-secondary text-center">Don't have an account? <a href="{{ route('register') }}" class="link text-decoration-none" style="color: #1ba371;">Register</a></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
  <script src="home/assets/js/bootstrap.bundle.min.js"></script>
  <script src="home/assets/js/jquery-3.7.1.min.js"></script>
  <script src="home/assets/js/main.js"></script>
</body>
</html>
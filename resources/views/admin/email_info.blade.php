<!doctype html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>slmart | admin</title>

    <!-- Bootstrap core CSS -->
    <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet">


    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="admin/assets/fontawesome/css/all.min.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="admin/assets/css/dashboard.css" rel="stylesheet">

</head>
<body>
    
    @include('admin.header')

    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-body">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Send Email</h1>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <h1>Send Email to <b>{{$order->email}}</b></h1>

                            <div class="Email-details">
                                <form action="{{url('send_user_email',$order->id)}}" method="POST" enctype="">
                                  @csrf
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Email Greeting</td>
                                                <td><input class="inputs-email" type="text" name="greeting" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Email First Line</td>
                                                <td><input class="inputs-email" type="text" name="firstline" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Email Body</td>
                                                <td><textarea class="input-description" name="body" placeholder="" required=""></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>Email Button Name</td>
                                                <td><input class="inputs-email" type="text" name="button" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Email URL</td>
                                                <td><input class="inputs-email" type="text" name="url" placeholder=""></td>
                                            </tr>
                                            <tr>
                                                <td>Email Last Line</td>
                                                <td><input class="inputs-email" type="text" name="lastline" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" class="btn primary-btn" name="submit" value="Send Email"></td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </form>

                            </div>

                            

                        </div>

                    </div>  

                </main>

            
            
        </div>
    </div>


    <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="admin/assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  
  </body>
</html>

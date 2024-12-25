<!doctype html>
<html lang="en">
    <head>
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
                        <h1 class="h2">Add Hot Deal</h1>
                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            @if(session()->has('message'))

                            <div class="alert alert-success d-flex justify-content-between align-items-center">
                                <span>{{ session()->get('message') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            @endif

                            <div class="product-details">
                                <form action="{{url('/add_deal')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Deal Title</td>
                                                <td><input class="input-product" type="text" name="title" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Deal Description</td>
                                                <td><input class="input-product" type="text" name="deal" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Product Name</td>
                                                <td><select class="select-drp" name="pname" required="">
                                                    <option value="" selected=""></option>
                                                    @foreach($product as $product)
                                                    <option value="{{$product->name}}">{{$product->name}}</option>
                                                    @endforeach
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td>End Date</td>
                                                <td><input class="input-product" type="date" name="enddate" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>End Time</td>
                                                <td><input class="input-product" type="time" name="endtime" placeholder="" required=""></td>
                                            </tr>

                                            <tr>
                                                <td>Deal Image</td>
                                                <td><input class="input-product" type="file" name="image" placeholder="" required=""></td>
                                            </tr>
                                            
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" class="btn primary-btn" name="submit" value="Add Deal"></td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </form>

                            </div>

                        </div>
                    </div> 
                    <div class="col-md-11">
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Deal Title</th>
                                <th scope="col">Deal Description</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">End Date</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Deal Image</th>
                                <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>

                            @foreach($hotdeal as $hotdeal)
                            <tbody>
                                <tr>
                                    <td class="align-middle">{{$hotdeal->title}}</td>
                                    <td class="align-middle">{{$hotdeal->deal}}</td>
                                    <td class="align-middle">{{$hotdeal->product_name}}</td>
                                    <td class="align-middle">{{$hotdeal->end_date}}</td>
                                    <td class="align-middle">{{$hotdeal->end_time}}</td>
                                    <td><img src="/hotdeals/{{$hotdeal->image}}" style="width: 200px;"></td>
                                    <td class="text-center align-middle"><a onclick="return confirm('Are You Sure to Delete this?')" href="{{url('delete_hotdeal',$hotdeal->id)}}"><i class="fa-solid fa-trash fa-lg del_icon"></i></a></td>
                                </tr>
                            </tbody>
                            @endforeach
                           
                            </table>

                        </div>  

                </main>

            </div>
            
        </div>

        <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
        <script src="admin/assets/js/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
    
    </body>
</html>

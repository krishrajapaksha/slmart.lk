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
                  <h1 class="h2">Category</h1>
              </div>

              <div class="row">

            <div class="col-md-6">

              @if(session()->has('message'))

              <div class="alert alert-success d-flex justify-content-between align-items-center">
                  <span>{{ session()->get('message') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              @endif
                  
                  <div class="category-details">
    
                    <h3 class="title">Add Category</h3>
                      
                    <form action="{{url('/add_category')}}" Method="POST" enctype="multipart/form-data">
                    @csrf
                      <input class="input" type="text" name="category" placeholder="Category Name" required="">
                      <input type="submit" class="btn primary-btn" name="submit" value="Add Category">
                      <input class="input-category" type="file" name="icon" placeholder="" required="">
                    </form>
                    
                  </div>
            </div>
            <div class="col-md-6">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Category Name</th>
                      <th scope="col">Icon</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>

                  @foreach($data as $data)
                  <tbody>
                    <tr>
                      <td class="align-middle">{{$data->category_name}}</td>
                      <td>
                          <img class="prev_icon" src="/category_icon/{{$data->icon}}">
                      </td>
                      <td class="text-center align-middle"><a onclick="return confirm('Are You Sure to Delete this?')" href="{{url('delete_category',$data->id)}}"><i class="fa-solid fa-trash fa-lg del_icon"></i></a></td>
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

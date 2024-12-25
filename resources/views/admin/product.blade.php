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
                        <h1 class="h2">Add Products</h1>
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
                                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Product Name</td>
                                                <td><input class="input-product" type="text" name="pname" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Product Slug</td>
                                                <td><input class="input-product" type="text" name="slug" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Short Description</td>
                                                <td><textarea class="input-description" name="shrtdes" placeholder=""></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td><textarea class="input-description" name="des" placeholder="" required=""></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>Regular Price</td>
                                                <td><input class="input-product" type="text" name="price" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Sale Price</td>
                                                <td><input class="input-product" type="text" name="saleprice" placeholder=""></td>
                                            </tr>
                                            <tr>
                                                <td>SKU</td>
                                                <td><input class="input-product" type="text" name="sku" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Stock</td>
                                                <td><select class="select-drp" name="stck" required="">
                                                    <option value="" selected=""></option>
                                                    <option>In Stock</option>
                                                    <option>Out Of Stock</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td>Featured</td>
                                                <td><select class="select-drp" name="ftrd">
                                                    <option value="" selected=""></option>
                                                    <option>New</option>
                                                    <option>Sale</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td>Quantity</td>
                                                <td><input class="input-product" type="number" min="0" name="qty" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Main Image</td>
                                                <td><input class="input-product" type="file" name="mainimage" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Auxiliary Image</td>
                                                <td><input class="input-product" type="file" name="auximage" placeholder=""></td>
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td><select class="select-drp" name="category" required="">
                                                    <option value="" selected=""></option>
                                                    @foreach($category as $category)
                                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td>Model</td>
                                                <td><input class="input-product" type="text" name="model" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Re-order Level</td>
                                                <td><input class="input-product" type="text" name="reordrlvl" placeholder="" required=""></td>
                                            </tr>
                                            <tr>
                                                <td>Brand</td>
                                                <td><select class="select-drp" name="brand" required="">
                                                    <option value="" selected=""></option>
                                                    @foreach($brand as $brand)
                                                    <option value="{{$brand->brand_name}}">{{$brand->brand_name}}</option>
                                                    @endforeach
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td>Supplier</td>
                                                <td><select class="select-drp" name="supplier" required="">
                                                <option value="" selected=""></option>
                                                    @foreach($supplier as $supplier)
                                                    <option value="{{$supplier->sup_name}}">{{$supplier->sup_name}}</option>
                                                    @endforeach
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" class="btn primary-btn" name="submit" value="Add Product"></td>
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

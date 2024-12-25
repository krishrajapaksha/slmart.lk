<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <div class="row my-4">
            <div class="col-sm-3">
                <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{$total_product}}</h1>
                    <p class="card-text">Total Products</p>
                </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{$total_order}}</h1>
                    <p class="card-text">Total Orders</p>
                    
                </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{$user}}</h1>
                    <p class="card-text">Total Customers</p>
                    
                </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Rs. {{ number_format($total_revenue,2,'.',',') }}</h2>
                    <p class="card-text">Total Revenue</p>
                </div>
                </div>
            </div>
            
        </div>
        <div class="row my-4">
            <div class="col-md-6 py-1">
                <div class="card">
                    <div class="card-body">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 py-1">
                <div class="card">
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <p style="font-size: 18px; font-weight: 600;">Re-Order Level Product</p>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th scope="col">Product Name</th>
                    <th class="text-center" scope="col">Re-order Level</th>
                    <th class="text-center" scope="col">Available Qty</th>
                    <th scope="col">Supplier Name</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($prdct as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td class="text-center">{{$product->reorder_level}}</td>
                        <td class="text-center {{ $product->quantity <= $product->reorder_level ? 'text-danger' : '' }}">
                            {{$product->quantity}}
                        </td>
                        <td>{{$product->supplier}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</main>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Order Details</h1>
                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Order Number</td>
                                <td>{{$order->id}}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$order->name}} {{$order->last_name}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$order->address}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$order->city}}</td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td>{{$order->zip_Code}}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{$order->phone}}</td>
                            </tr>
                            <tr>
                                <td>Grandtotal</td>
                                <td>Rs. {{ number_format($order->grand_total,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>{{$order->payment_status}}</td>
                            </tr>
                            <tr>
                                <td>Delivery Status</td>
                                <td>{{$order->delivery_status}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row">
                <div class="col-md-8">

                    <div class="product-details">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col" class="text-center">QTY</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderItems as $orderItem)
                                <tr>
                                    <td class="align-middle">{{$orderItem->name}}</td>
                                    <td class="align-middle text-center">{{$orderItem->qty}}</td>
                                    <td class="align-middle text-center">Rs. {{ number_format($orderItem->price,2,'.',',') }}</td>
                                    <td class="align-middle text-center">Rs. {{ number_format($orderItem->total,2,'.',',') }}</td>
                                    
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        
                    </div>

                
                </div>
            </div>   
</body>
</html>
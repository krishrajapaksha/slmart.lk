<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ReviewRating;
use App\Models\slider;
use App\Models\Hotdeal;
use App\Models\brand;
use App\Models\CustomerAddress;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(20);
        $category=Category::orderby("category_name","ASC")->get();
        $slider=slider::all();
        $hotdeal = Hotdeal::all();
        $rating = ReviewRating::all();
        
        return view('home.userpage',compact('product','category','slider','hotdeal','rating'));
    }

    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='admin')
        {
                    // Count total products, orders, and users
            $total_product = Product::count();
            $total_order = Order::count();
            $user = User::count();

            $prdct = Product::orderby("name","ASC")->get();

            // Retrieve all orders
            $orders = Order::all();

            // Initialize variables for total revenue, delivered orders, and canceled orders
            $total_revenue = 0;
            $total_delivered = 0;
            $total_canceled = 0;

            // Calculate total revenue and count of delivered and canceled orders
            foreach ($orders as $order) {
                $total_revenue += $order->subtotal;
                if ($order->delivery_status === 'Delivered') {
                    $total_delivered++;
                } elseif ($order->delivery_status === 'Cancelled') {
                    $total_canceled++;
                }
            }

            // Calculate percentage of ordered, canceled, and delivered orders
            $total_ordered = $total_order - $total_delivered - $total_canceled;
            $percentage_ordered = ($total_ordered / $total_order) * 100;
            $percentage_canceled = ($total_canceled / $total_order) * 100;
            $percentage_delivered = ($total_delivered / $total_order) * 100;

            // Group orders by creation date and calculate revenue day by day
            $revenue_by_day = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(subtotal) as revenue'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->get();

            // Pass data to the view
            return view('admin.home', compact('total_product', 'total_order', 'user', 'total_revenue', 'revenue_by_day', 'percentage_ordered', 'percentage_canceled', 'percentage_delivered','prdct'));

        }
        else
        {
            $id=Auth::user()->id;
            $total_cart=cart::where('user_id','=',$id)->get()->count();
            
            $product=Product::paginate(20);
            $category=Category::orderby("category_name","ASC")->get();
            $slider=slider::all();
            $hotdeal=Hotdeal::all();
            return view('home.userpage',compact('product','category','total_cart','slider','hotdeal'));
        }

    }

    public function product_details($id)
    {
        $product=product::find($id);
        $productId=$product->id;
        $category=Category::orderby("category_name","ASC")->get();

        $avgRate=ReviewRating::where('product_id','=',$productId)->avg('star_rating');

        $revrate=ReviewRating::where('product_id','=',$productId)->get();

        return view('home.product_details',compact('product','revrate','avgRate','category'));
    }

    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {   
            $user=Auth::user();
            $userid=$user->id;
            $product=product::find($id);
            $product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if($product_exist_id)
            {
                $cart=cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->qty;
                $cart->save();

                Alert::success('Product Added Successfully!','We have added product to the Cart');
                return redirect()->back();

            }

            else
            {
                $cart=new cart;
                $cart->user_id=$user->id;
                $cart->product_id=$product->id;

                $cart->name=$user->name;
                $cart->last_name=$user->last_name;
                $cart->email=$user->email;
                $cart->phone=$user->phone;
                $cart->address=$user->address;
                
                $cart->product_name=$product->name;

                if($product->sale_price!=null)
                {
                    $cart->price=$product->sale_price;
                    
                }
                else
                {
                    $cart->price=$product->regular_price;
                    
                }

                
                
                $cart->image=$product->main_image;
                

                if($request->qty!=null)
                {
                    $cart->quantity=$request->qty;
                }

                $cart->save();

                Alert::success('Product Added Successfully!','We have added product to the Cart');
                return redirect()->back();

            }

        }   
        else
        {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();
            $category=Category::orderby("category_name","ASC")->get();
            return view('home.show_cart',compact('cart','category'));

        }
        else
        {
            return redirect('login');
        }
        
    }

    public function remove_cart($id)
    {
        if(Auth::id())
        {
            $cart=cart::find($id);
            $cart->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
        

    }


    // PHP (HomeController)
    public function update_quantity(Request $request)
    {
        // Retrieve data from the request
        $id = $request->input('id');
        $quantity = $request->input('quantity');

        // Update quantity in the database
        $cart = Cart::find($id);
        if ($cart) {
            $cart->quantity = $quantity;
            $cart->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cart item not found.']);
        }
    }



    public function show_checkout()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $category=Category::orderby("category_name","ASC")->get();
            $cart=cart::where('user_id','=',$id)->get();
            $customerAddress = CustomerAddress::where('user_id','=',$id)->first();
            return view('home.show_checkout',compact('cart','customerAddress','category'));
        }
        else
        {
            return redirect('login');
        }

       

    }

    public function place_order(Request $request)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userId = $user->id;
            $cartItems = Cart::where('user_id', $userId)->get();

            $user_exist_id=CustomerAddress::where('user_id','=',$userId)->first();

            if(!$user_exist_id)
            {
                $customerAddress = new CustomerAddress;   
                $customerAddress->user_id = $user->id;
                $customerAddress->name = $request->input('firstname');
                $customerAddress->last_name = $request->input('lastname');
                $customerAddress->phone = $request->input('tel');
                $customerAddress->address = $request->input('address');
                $customerAddress->city = $request->input('city');
                $customerAddress->zip_Code = $request->input('zipcode');

                $customerAddress->save();
            }

            $order = new Order;

            $order->user_id = $user->id;
            $order->subtotal = $request->input('subtotal');
            $order->shipping = $request->input('shippinfee');
            $order->grand_total = $request->input('grandtotal');
            $order->name = $request->input('firstname');
            $order->last_name = $request->input('lastname');
            $order->email = $user->email;
            $order->phone = $request->input('tel');
            $order->address = $request->input('address');
            $order->city = $request->input('city');
            $order->zip_Code = $request->input('zipcode');
            $order->payment_status = $request->input('payment');
            $order->delivery_status = 'Processing';

            $order->save();

            foreach($cartItems as $cartItem)
            {
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cartItem->product_id;
                $orderItem->image = $cartItem->image;
                $orderItem->name = $cartItem->product_name;
                $orderItem->qty = $cartItem->quantity;
                $orderItem->price  = $cartItem->price;
                $orderItem->total = $cartItem->price * $cartItem->quantity;

                $orderItem->save();

                $product = Product::find($cartItem->product_id);
                if ($product) {
                    $product->quantity -= $cartItem->quantity;
                    $product->save();
                }
            }
            
            Cart::where('user_id', $userId)->delete();
            
            return redirect()->back()->with('message','We have Received Your Order. We will Connect with You Soon...');
        }
        else
        {
            return redirect('login');
        }

    }

    public function show_order()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $category=Category::orderby("category_name","ASC")->get();
            $userid=$user->id;
            $order=order::where('user_id','=',$userid)->get();
            $orderItems=OrderItem::all();
            return view('home.order',compact('order','orderItems','category'));
        }
        else
        {
            return redirect('login');
        }

    }

    public function cancel_order($id)
    {
        if(Auth::id())
        {
            
            $order=order::find($id);
            $order->delivery_status='Cancelled';
            $order->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

    }


    public function show_rate_review($id)
    {
        if(Auth::id())
        {
            $product=product::find($id);
            $productId=$product->id;
            $avgRate=ReviewRating::where('product_id','=',$productId)->avg('star_rating');
            $revrate=ReviewRating::where('product_id','=',$productId)->get();
            return view('home.rate_review',compact('product','revrate','avgRate'));
        }
        else
        {
            return redirect('login');
        }

                
    }

    public function add_rate_review(Request $request,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $product=product::find($id);

            $revrate = new ReviewRating();
            $revrate->product_id = $product->id;
            $revrate->comment= $request->comment;
            $revrate->star_rating = $request->rating;
            $revrate->user_id = $user->id;
            $revrate->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

    }

    public function product_search(Request $request)
    {
        $search_text = $request->q;

        $sortby = $request->query("sortby");
        if (!$sortby)
            $sortby = -1;
        $s_column = "";
        $s_sort = "";

        switch ($sortby) {
            case 1:
                $s_column = "regular_price";
                $s_sort = "ASC";
                break;
            case 2:
                $s_column = "regular_price";
                $s_sort = "DESC";
                break;
            default:
                $s_column = "id";
                $s_sort = "DESC";
        }

        $brands = Brand::orderBy("brand_name", "ASC")->get();
        $category = Category::orderBy("category_name", "ASC")->get();
        $q_brands = $request->query("brands");
        $minPrice = $request->query("minprice");
        $maxPrice = $request->query("maxprice");

        if (!$minPrice || !$maxPrice) {
            $minPrice = 1;
            $maxPrice = 300000;
        }

        $product = Product::where(function ($query) use ($search_text) {
                $query->where('name', 'LIKE', "%$search_text%")
                    ->orWhere('category', 'LIKE', "%$search_text%")
                    ->orWhere('brand', 'LIKE', "%$search_text%");
            })
            ->when($q_brands, function ($query) use ($q_brands) {
                $query->whereIn('brand_id', explode(',', $q_brands));
            })
            ->whereBetween('regular_price', [$minPrice, $maxPrice])
            ->orderBy($s_column, $s_sort)
            ->paginate(6);

        return view('home.shop', compact('product', 'brands', 'q_brands', 'minPrice', 'maxPrice', 'sortby', 'category'));
    }


    

    public function show_address()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $category=Category::orderby("category_name","ASC")->get();
            $customerAddress=CustomerAddress::where('user_id','=',$userid)->get();
            return view('home.address',compact('customerAddress','category'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function edit_address(Request $request,$id)
    {
        if(Auth::id())
        {
            $customerAddress=CustomerAddress::find($id);
       
            $customerAddress->name=$request->name;

            $customerAddress->last_name=$request->lname;

            $customerAddress->address=$request->address;

            $customerAddress->city=$request->city;

            $customerAddress->zip_Code=$request->zipCode;

            $customerAddress->phone=$request->phone;

            $customerAddress->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

    }

    public function products(Request $request)
    {
        
        $sortby = $request->query("sortby");
        if(!$sortby)
            $sortby = -1;
        $s_column = "";
        $s_sort = "";
        
        switch ($sortby) {
            case 1:
                $s_column = "regular_price";
                $s_sort = "ASC";
                break;
            case 2:
                $s_column = "regular_price";
                $s_sort = "DESC";
                break;
            default:
                $s_column = "id";
                $s_sort = "DESC";
        }
        $brands=brand::orderby("brand_name","ASC")->get();
        $category=Category::orderby("category_name","ASC")->get();
        $q_brands = $request->query("brands");
        $minPrice = $request->query("minprice");
        $maxPrice = $request->query("maxprice");

        if (!$minPrice || !$maxPrice) {
            $minPrice = 1;
            $maxPrice = 300000;
        }


        $product=Product::where(function($query) use($q_brands){
            $query->whereIn('brand_id',explode(',',$q_brands))->orwhereRaw("'".$q_brands."'=''");
        })->whereBetween('regular_price', [$minPrice, $maxPrice])
        ->orderby($s_column,$s_sort)
        ->paginate(6);
        
        return view('home.shop',compact('product','brands','q_brands','minPrice','maxPrice','sortby','category'));
    }

    public function category_products(Request $request,$id)
    {
        $cat=Category::find($id);
        $categoryId=$cat->id;
        
        $category=Category::orderby("category_name","ASC")->get();
       
        $sortby = $request->query("sortby");
        if(!$sortby)
            $sortby = -1;
        $s_column = "";
        $s_sort = "";
        
        switch ($sortby) {
            case 1:
                $s_column = "regular_price";
                $s_sort = "ASC";
                break;
            case 2:
                $s_column = "regular_price";
                $s_sort = "DESC";
                break;
            default:
                $s_column = "id";
                $s_sort = "DESC";
        }
        $brands=brand::orderby("brand_name","ASC")->get();
        $q_brands = $request->query("brands");
        $minPrice = $request->query("minprice");
        $maxPrice = $request->query("maxprice");

        if (!$minPrice || !$maxPrice) {
            $minPrice = 1;
            $maxPrice = 300000;
        }


        $product=Product::where('category_id','=',$categoryId)->where(function($query) use($q_brands){
            $query->whereIn('brand_id',explode(',',$q_brands))->orwhereRaw("'".$q_brands."'=''");
        })->whereBetween('regular_price', [$minPrice, $maxPrice])
        ->orderby($s_column,$s_sort)
        ->paginate(6);
        
        return view('home.shop',compact('product','brands','q_brands','minPrice','maxPrice','sortby','category'));

    }

    public function newarrival_products(Request $request)
    {       
        $sortby = $request->query("sortby");
        if(!$sortby)
            $sortby = -1;
        $s_column = "";
        $s_sort = "";
        
        switch ($sortby) {
            case 1:
                $s_column = "regular_price";
                $s_sort = "ASC";
                break;
            case 2:
                $s_column = "regular_price";
                $s_sort = "DESC";
                break;
            default:
                $s_column = "id";
                $s_sort = "DESC";
        }
        $brands=brand::orderby("brand_name","ASC")->get();
        $category=Category::orderby("category_name","ASC")->get();
        $q_brands = $request->query("brands");
        $minPrice = $request->query("minprice");
        $maxPrice = $request->query("maxprice");

        if (!$minPrice || !$maxPrice) {
            $minPrice = 1;
            $maxPrice = 300000;
        }


        $product=Product::where('featured','=',"New")->where(function($query) use($q_brands){
            $query->whereIn('brand_id',explode(',',$q_brands))->orwhereRaw("'".$q_brands."'=''");
        })->whereBetween('regular_price', [$minPrice, $maxPrice])
        ->orderby($s_column,$s_sort)
        ->paginate(6);
        
        return view('home.shop',compact('product','brands','q_brands','minPrice','maxPrice','sortby','category'));

    }

    public function sale_products(Request $request)
    {       
        $sortby = $request->query("sortby");
        if(!$sortby)
            $sortby = -1;
        $s_column = "";
        $s_sort = "";
        
        switch ($sortby) {
            case 1:
                $s_column = "regular_price";
                $s_sort = "ASC";
                break;
            case 2:
                $s_column = "regular_price";
                $s_sort = "DESC";
                break;
            default:
                $s_column = "id";
                $s_sort = "DESC";
        }
        $brands=brand::orderby("brand_name","ASC")->get();
        $category=Category::orderby("category_name","ASC")->get();
        $q_brands = $request->query("brands");
        $minPrice = $request->query("minprice");
        $maxPrice = $request->query("maxprice");

        if (!$minPrice || !$maxPrice) {
            $minPrice = 1;
            $maxPrice = 300000;
        }


        $product=Product::where('featured','=',"Sale")->where(function($query) use($q_brands){
            $query->whereIn('brand_id',explode(',',$q_brands))->orwhereRaw("'".$q_brands."'=''");
        })->whereBetween('regular_price', [$minPrice, $maxPrice])
        ->orderby($s_column,$s_sort)
        ->paginate(6);
        
        return view('home.shop',compact('product','brands','q_brands','minPrice','maxPrice','sortby','category'));

    }

    public function save_address (Request $request)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $address = new CustomerAddress;

            $address->user_id = $user->id;
            $address->name = $request->input('name');
            $address->last_name = $request->input('lname');
            $address->phone = $request->input('phone');
            $address->address = $request->input('address');
            $address->city = $request->input('city');
            $address->zip_Code = $request->input('zipCode');

            $address->save();
            
            return redirect()->back()->with('message','Your Address Saved');
        }
        else
        {
            return redirect('login');
        }

    }
}
 
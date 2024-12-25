<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\brand;
use App\Models\slider;
use App\Models\supplier;
use App\Models\Hotdeal;
use App\Models\OrderItem;

use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id())
        {
            $data=category::all();
            return view('admin.category',compact('data'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function add_category(Request $request)
    {
        if(Auth::id())
        {
            $data=new category;
            $data->category_name=$request->category;

            $icon=$request->icon;

            $iconname=time().'.'.$icon->getClientOriginalExtension();

            $request->icon->move('category_icon',$iconname);

            $data->icon=$iconname;

            $data->save();
            return redirect()->back()->with('message','Category Added Successfully');
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function delete_category($id)
    {
        if(Auth::id())
        {
            $data=category::find($id);
            $data->delete();
            return redirect()->back()->with('message','Category Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }

       
    }


    public function view_product()
    {
        if(Auth::id())
        {
            
            $category=category::all();
            $brand=brand::all();
            $supplier=supplier::all();
            return view('admin.product',compact('category','brand','supplier'));
        }
        else
        {
            return redirect('login');
        }

    }

    public function add_product(Request $request)
    {
        if(Auth::id())
        {
            $product=new product;

            $product->name=$request->pname;

            $product->slug=$request->slug;

            $product->short_description=$request->shrtdes;

            $product->description=$request->des;

            $product->regular_price=$request->price;

            $product->sale_price=$request->saleprice;

            $product->sku=$request->sku;

            $product->stock=$request->stck;

            $product->featured=$request->ftrd;

            $product->quantity=$request->qty;


            $image=$request->mainimage;

            $mimagename=time().'.'.$image->getClientOriginalExtension();

            $request->mainimage->move('product',$mimagename);

            $product->main_image=$mimagename;


            $imagex=$request->auximage;

            if($imagex)
            {
                $aimagename=time().'x.'.$imagex->getClientOriginalExtension();

                $request->auximage->move('product',$aimagename);

                $product->aux_image=$aimagename;

            }

            $category = Category::where('category_name', $request->category)->first();
            if ($category) {
                $product->category_id = $category->id;
                $product->category = $request->category;
            } else {
                return redirect()->back()->with('error','Category not found');
            }

            $product->model=$request->model;

            $product->reorder_level=$request->reordrlvl;

            $brand = brand::where('brand_name', $request->brand)->first();
            if ($brand) {
                $product->brand_id= $brand->id;
                $product->brand=$request->brand;
            } else {
                return redirect()->back()->with('error','Brand not found');
            }

            $supplier = supplier::where('sup_name', $request->supplier)->first();
            if ($supplier) {
                $product->supplier_id= $supplier->id;
                $product->supplier = $request->supplier;
            } else {
                return redirect()->back()->with('error','Supplier not found');
            }


            $product->save();
            return redirect()->back()->with('message','Product Added Successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function show_product()
    {
        if(Auth::id())
        {
            $product=product::all();
            return view('admin.show_product',compact('product'));
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function delete_product($id)
    {
        if(Auth::id())
        {
            $product=product::find($id);
            $product->delete();
            return redirect()->back()->with('message','Product Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }

       
    }

    public function update_product($id)
    {
        if(Auth::id())
        {
            $product=product::find($id);
            $category=category::all();
            $brand=brand::all();
            $supplier=supplier::all();
            return view('admin.update_product',compact('product','category','brand','supplier'));
        }
        else
        {
            return redirect('login');
        }

    }

    public function update_product_confirm(Request $request,$id)
    {
        if(Auth::id())
        {
            $product=product::find($id);
       
            $product->name=$request->pname;

            $product->slug=$request->slug;

            $product->short_description=$request->shrtdes;

            $product->description=$request->des;

            $product->regular_price=$request->price;

            $product->sale_price=$request->saleprice;

            $product->sku=$request->sku;

            $product->stock=$request->stck;

            $product->featured=$request->ftrd;

            $product->quantity=$request->qty;


            $image=$request->mainimage;

            if($image)
            {
                $mimagename=time().'.'.$image->getClientOriginalExtension();

                $request->mainimage->move('product',$mimagename);
        
                $product->main_image=$mimagename;

            }

            $imagex=$request->auximage;

            if($imagex)
            {
                $aimagename=time().'x.'.$imagex->getClientOriginalExtension();

                $request->auximage->move('product',$aimagename);

                $product->aux_image=$aimagename;

            }

            $category = Category::where('category_name', $request->category)->first();
            if ($category) {
                $product->category_id = $category->id;
                $product->category = $request->category;
            } else {
                return redirect()->back()->with('error','Category not found');
            }

            $product->model=$request->model;

            $product->reorder_level=$request->reordrlvl;

            $brand = brand::where('brand_name', $request->brand)->first();
            if ($brand) {
                $product->brand_id= $brand->id;
                $product->brand=$request->brand;
            } else {
                return redirect()->back()->with('error','Brand not found');
            }

            $supplier = supplier::where('sup_name', $request->supplier)->first();
            if ($supplier) {
                $product->supplier_id= $supplier->id;
                $product->supplier = $request->supplier;
            } else {
                return redirect()->back()->with('error','Supplier not found');
            }

            $product->save();
            return redirect()->back()->with('message','Product Updated Successfully');
        }
        else
        {
            return redirect('login');
        }

    }

    public function order()
    {
        if(Auth::id())
        {
            $order=order::all();
            return view('admin.order',compact('order'));

        }
        else
        {
            return redirect('login');
        }

        
    }

    public function view_order_details($id)
    {
        if(Auth::id())
        {
            $order=order::find($id);
            $orderId=$order->id;
            $orderItems=OrderItem::where('order_id','=',$orderId)->get();
            return view('admin.order_details',compact('orderItems','order'));

        }
        else
        {
            return redirect('login');
        }
    }

    public function delivered($id)
    {
        if(Auth::id())
        {
            $order=order::find($id);
            $order->delivery_status="Delivered";
            $order->payment_status="Paid";
            $order->save();
            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }


    }

    public function print_pdf($id)
    {
        if(Auth::id())
        {
            $order=order::find($id);
            $orderId=$order->id;
            $orderItems=OrderItem::where('order_id','=',$orderId)->get();
            $pdf=PDF::loadView('admin.pdf',compact('order','orderItems'));
            return $pdf->download('order_details');
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function send_email($id)
    {
        if(Auth::id())
        {
            $order=order::find($id);
            return view('admin.email_info',compact('order'));
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function send_user_email(Request $request,$id)
    {
        if(Auth::id())
        {
            
            $order=order::find($id);
            $details=[
                'greeting'=>$request->greeting,
                'firstline'=>$request->firstline,
                'body'=>$request->body,
                'button'=>$request->button,
                'url'=>$request->url,
                'lastline'=>$request->lastline
            ];
            Notification::send($order,new SendemailNotification($details));
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

    }  
    
    public function searchdata(Request $request)
    {
        if(Auth::id())
        {
            $searchText=$request->search;
            $order=order::where('name','LIKE',"%$searchText%")
            ->orWhere('phone','LIKE',"%$searchText%")
            ->orWhere('id','LIKE',"%$searchText%")
            ->orWhere('payment_status','LIKE',"%$searchText%")
            ->orWhere('delivery_status','LIKE',"%$searchText%")
            ->orWhere('city','LIKE',"%$searchText%")
            ->orWhere('zip_Code','LIKE',"%$searchText%")->get();
            return view('admin.order',compact('order'));
        }
        else
        {
            return redirect('login');
        }

    }

    public function brand_supplier()
    {
        if(Auth::id())
        {
            $data=brand::all();
            $datas=supplier::all();
            return view('admin.brand_supplier',compact('data','datas'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function add_brand(Request $request)
    {
        if(Auth::id())
        {
            $data=new brand;
            $data->brand_name=$request->brand;
            $data->save();
            return redirect()->back()->with('brand_message','Brand Added Successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function add_supplier(Request $request)
    {
        if(Auth::id())
        {
            $data=new supplier;
            $data->sup_name=$request->supplier;
            $data->save();
            return redirect()->back()->with('supplier_message','Supplier Added Successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function delete_supplier($id)
    {
        if(Auth::id())
        {
            $datas=supplier::find($id);
            $datas->delete();
            return redirect()->back()->with('supplier_message','Supplier Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function delete_brand($id)
    {
        if(Auth::id())
        {
            $datas=brand::find($id);
            $datas->delete();
            return redirect()->back()->with('brand_message','Brand Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }


    public function home_slider()
    {
        if(Auth::id())
        {
            $product=Product::all();
            $data=slider::all();

            return view('admin.home_slider',compact('product','data'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function add_slide(Request $request)
    {
        if(Auth::id())
        {
            $slider = new slider;

            $productname = $request->input('pname');
            $product = Product::where('name', $productname)->first();

            if ($product) {
                $productbrand = $product->brand;
                $productId = $product->id;
                $slider->brand = $productbrand;
                $slider->product_id = $productId;
            } else {
                // Handle the case where product is not found
                return redirect()->back()->with('error', 'Product not found.');
            }

            $slider->sale_type = $request->offertype;
            $slider->product_name = $productname;
            $slider->image = null; // Default value for now, we'll update it if an image is uploaded

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $mimagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move('sliders', $mimagename);
                $slider->image = $mimagename;
            }

            $slider->save();

            return redirect()->back()->with('message', 'Slider Added Successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }


    public function delete_slide($id){
        if(Auth::id())
        {
            $data=slider::find($id);
            $data->delete();
            return redirect()->back()->with('message','Slider Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }

    }

    public function hot_deal(){
        if(Auth::id())
        {
            $product=product::all();
            $hotdeal=Hotdeal::all();
            return view('admin.hot_deal',compact('product','hotdeal'));
        }
        else
        {
            return redirect('login');
        }

    }

    public function add_deal(Request $request)
    {
        if(Auth::id())
        {
            $hotdeal = new Hotdeal;

            $productname = $request->input('pname');

            $product = Product::where('name', $productname)->first();

            if ($product) {
                $hotdeal->brand = $product->brand;
                $hotdeal->product_id = $product->id;
            } else {
                return redirect()->back()->with('error', 'Product not found');
            }

            $hotdeal->title = $request->title;
            $hotdeal->deal = $request->deal;
            $hotdeal->product_name = $request->pname;
            $hotdeal->end_date = $request->enddate;
            $hotdeal->end_time = $request->endtime;

            $image = $request->file('image');

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('hotdeals', $imagename);
            $hotdeal->image = $imagename;

            $hotdeal->save();

            return redirect()->back()->with('message', 'Hot Deal Added Successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }


    public function delete_hotdeal($id){
        if(Auth::id())
        {
            $hotdeal=Hotdeal::find($id);
            $hotdeal->delete();
            return redirect()->back()->with('message','Hot Deal Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }

    }


}

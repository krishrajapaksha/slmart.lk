<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

route::get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');

route::get('/view_category',[AdminController::class,'view_category']);

route::post('/add_category',[AdminController::class,'add_category']);

route::get('/delete_category/{id}',[AdminController::class,'delete_category']);


route::get('/view_product',[AdminController::class,'view_product']);

route::post('/add_product',[AdminController::class,'add_product']);

route::get('/show_product',[AdminController::class,'show_product']);

route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

route::get('/update_product/{id}',[AdminController::class,'update_product']);

route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);

route::get('/order',[AdminController::class,'order']);

route::get('/view_order_details/{id}',[AdminController::class,'view_order_details']);

route::get('/delivered/{id}',[AdminController::class,'delivered']);

route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);

route::get('/send_email/{id}',[AdminController::class,'send_email']);

route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);

route::get('/search',[AdminController::class,'searchdata']);

route::get('/brand_supplier',[AdminController::class,'brand_supplier']);

route::post('/add_brand',[AdminController::class,'add_brand']);

route::get('/delete_brand/{id}',[AdminController::class,'delete_brand']);

route::post('/add_supplier',[AdminController::class,'add_supplier']);

route::get('/delete_supplier/{id}',[AdminController::class,'delete_supplier']);

route::get('/home_slider',[AdminController::class,'home_slider']);

route::post('/add_slide',[AdminController::class,'add_slide']);

route::get('/delete_slide/{id}',[AdminController::class,'delete_slide']);

route::get('/hot_deal',[AdminController::class,'hot_deal']);

route::post('/add_deal',[AdminController::class,'add_deal']);

route::get('/delete_hotdeal/{id}',[AdminController::class,'delete_hotdeal']);





route::get('/product_details/{id}',[HomeController::class,'product_details']);

route::post('/add_cart/{id}',[HomeController::class,'add_cart']);

route::get('/show_cart',[HomeController::class,'show_cart']);

route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);

route::post('/update_quantity', [HomeController::class, 'update_quantity']);

route::get('/show_checkout',[HomeController::class,'show_checkout']);

route::post('/place_order',[HomeController::class,'place_order']);

route::get('/show_order',[HomeController::class,'show_order']);

route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);

route::get('/rate_review/{id}',[HomeController::class,'show_rate_review']);

route::post('/add_rate_review/{id}',[HomeController::class,'add_rate_review']);

route::get('/product_search',[HomeController::class,'product_search']);

route::get('/shop',[HomeController::class,'products']);

route::get('/show_address',[HomeController::class,'show_address']);

route::get('/edit_address/{id}',[HomeController::class,'edit_address']);

route::get('/category_products/{id}',[HomeController::class,'category_products']);

route::get('/new_arrivals',[HomeController::class,'newarrival_products']);

route::get('/sale_products',[HomeController::class,'sale_products']);

route::get('/save_address',[HomeController::class,'save_address']);
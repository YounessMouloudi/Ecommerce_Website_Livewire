<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\FrontendController;
use App\Livewire\Admin\Brand\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(FrontendController::class)->group(function(){
    
    Route::get('/','index')->name('home_page');
    
    Route::get('collections','categories')->name('categories');
    
    Route::get('collections/{slug}','products')->name('home_products');
    
    Route::get('collections/{categorie_slug}/{prod_slug}/{prod_name}','productView')->name('view_product');
    
    Route::get('new-arrivals','newArrivals')->name('new_arrivals');
    
    Route::get('featured-products','featuredProducts')->name('featured');
    
    Route::get('search','searchProducts')->name('search');
    
    Route::get('thanks','thanks')->name('thanks');
});

Route::middleware('auth')->group(function(){

    Route::get('wishlists',[WishlistController::class,'index'])->name('wishlists');
    Route::get('cart',[CartController::class,'index'])->name('cart');
    Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');
    Route::get('orders',[OrderController::class,'index'])->name('orders');
    Route::get('orders/{id}',[OrderController::class,'show'])->name('view_order');

    Route::get('profile',[FrontendUserController::class,'index'])->name('profile');
    Route::post('profile',[FrontendUserController::class,'updateUserDetails'])->name('update_profile');

    Route::get('change-password',[FrontendUserController::class,'passwordCreate'])->name('change-password');
    Route::post('change-password',[FrontendUserController::class,'changePassword'])->name('update_password');

    Route::get('mail-invoice/{id}',[FrontendUserController::class,'mailInvoice'])->name('mail_invoice');


});


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){

    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    Route::get('settings', [SettingController::class,'index'])->name('settings');
    
    Route::post('settings', [SettingController::class,'store'])->name('save_settings');

    Route::get('brands', [BrandController::class,'index'])->name('brand');

    
    Route::controller(CategorieController::class)->group(function(){

        Route::get('categories', 'index')->name('cat');

        Route::get('categories/create', 'create')->name('add_categorie');
        
        Route::post('categories', 'store')->name('save_categorie');
    
        Route::get('categories/{categorie}/edit', 'edit')->name('edit_categorie');
    
        Route::put('categories/{categorie}', 'update')->name('update_categorie');

        // Route::delete('categorie/{categorie}', 'destroy')->name('delete_categorie');

    });
    
    Route::controller(ProductController::class)->group(function(){

        Route::get('products','index')->name('products');

        Route::get('products/create','create')->name('add_product');
        
        Route::post('products','store')->name('save_product');
        
        Route::get('products/{product}/edit','edit')->name('edit_product');

        Route::put('products/{product}','update')->name('update_product');

        Route::get('products/{product}/delete','destroy')->name('delete_product');

        Route::get('product-image/{product}/delete','destroyImage')->name('delete_image');

        Route::post('product-color/{product}','updateProductColor');

        Route::get('product-color/{product}/delete','deleteProductColor');
        
    });

    Route::controller(ColorController::class)->group(function(){

        Route::get('colors','index')->name('colors');

        Route::get('colors/create','create')->name('add_color');
        
        Route::post('colors','store')->name('save_color');
        
        Route::get('colors/{color}/edit','edit')->name('edit_color');

        Route::put('colors/{color}','update')->name('update_color');

        Route::get('colors/{color}/delete','destroy')->name('delete_color');
        
    });

    Route::controller(SliderController::class)->group(function(){

        Route::get('sliders','index')->name('sliders');

        Route::get('sliders/create','create')->name('add_slider');
        
        Route::post('sliders','store')->name('save_slider');
        
        Route::get('sliders/{slider}/edit','edit')->name('edit_slider');

        Route::put('sliders/{slider}','update')->name('update_slider');

        Route::get('sliders/{slider}/delete','destroy')->name('delete_slider');
        
    });

    Route::controller(AdminOrderController::class)->group(function(){

        Route::get('orders','index')->name('all_orders');
        Route::get('orders/{id}','show')->name('show_order');
        Route::put('orders/{id}','updateStatusOrder')->name('update_status_order');
        Route::get('invoice/{id}/pdf','downloadInvoice')->name('download_pdf');
        Route::get('invoice/{id}','viewInvoice')->name('view_invoice');
        Route::get('invoice/{id}/mail','sendInvoice')->name('send_invoice');
    });

    Route::controller(UserController::class)->group(function(){

        Route::get('users','index')->name('users');
        Route::get('users/create','create')->name('add_user');
        Route::post('users','store')->name('save_user');
        Route::get('users/{id}/edit','edit')->name('edit_user');
        Route::put('users/{id}','update')->name('update_user');
        Route::get('users/{id}/delete','destroy')->name('delete_user');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

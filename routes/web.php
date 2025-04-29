<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Home\CollectionController;
use App\Http\Controllers\Home\ViewProductController;

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

## featured products
Route::get('/', [ViewProductController::class, 'homePage'])->name('homePage');
Route::get('/productbuy/{slug}', [ViewProductController::class, 'show'])->name('product.show');


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('contact-us',[ContactController::class,'contactUs'])->name('contactus');
Route::post('/contact/store', [ContactController::class, 'contactStore']);
## Policies
Route::view('privacy-policy', 'policy.privacy')->name('policy.privacy');
Route::view('shipping-policy', 'policy.shipping')->name('policy.shipping');
Route::view('terms-and-conditions', 'policy.terms-condition')->name('policy.terms');




## carts 
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/get-cart', [CartController::class, 'getCart']);
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

Route::post('/remove-item-from-cart', [CartController::class, 'removeItemFromCart']);
Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity']);



## category products -- collections
Route::get('/collections', [CollectionController::class, 'index'])->name('collections');
Route::get('shop/{slug}', [CollectionController::class, 'show'])->name('category.show');
Route::get('/brand/{slug}', [CollectionController::class, 'brandProducts'])->name('brandproducts');

## BuyNow
Route::post('/buy-it-now',[UserController::class,'buyNow'])->name('buyNow');

## authenticate routes
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [UserController::class, 'account'])->name('account');
    Route::get('/view-order/{id}', [UserController::class, 'viewOrder'])->name('view.order');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/update-password', [UserController::class, 'updatePassword']);
    Route::post('/order-track',[UserController::class,'trackOrder'])->name('order.track');
    Route::get('/order-tracking/{id}',[UserController::class,'trackOrderStatus'])->name('order.trackStatus');


    Route::get('/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::post('/submit-order', [OrderController::class, 'submitOrder'])->name('submitOrder');

    // phonepe integration
    Route::get('/payment-method', [OrderController::class, 'makePhonePePayment'])->name('phonepe.payment');
    Route::post('/payment/callback', [OrderController::class, 'phonePeCallback'])->name('phonepe.payment.callback');
    Route::post('/payment-refund', [OrderController::class, 'phonePeRefundAPI'])->name('phonepe.payment.refund');
    Route::get('/payment/success',[OrderController::class,'paymentSuccess'])->name('payment.success');


});

## Admin Control  Routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    ## Dashboard  Routes
    Route::get('dashboard', [AdminController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('contact/view', [AdminController::class, 'contactView'])->name('contact.view');
    Route::get('user/view', [AdminController::class, 'userView'])->name('user.view');

    ## Banners  Routes
    Route::prefix('banner')->group(function () {
        Route::get('add', [BannerController::class, 'add'])->name('addBanner');
        Route::post('store', [BannerController::class, 'store']);
        Route::get('view', [BannerController::class, 'view'])->name('viewBanner');
        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('editBanner');
        Route::post('update/{id}', [BannerController::class, 'update'])->name('updateBanner');
        Route::delete('delete/{id}', [BannerController::class, 'delete'])->name('deleteBanner');

    });

    ## Brand  Routes
    Route::prefix('brands')->group(function () {
        Route::get('add-brand', [BrandController::class, 'add'])->name('add-brand');
        Route::post('store', [BrandController::class, 'store']);
        Route::get('all-brands', [BrandController::class, 'view'])->name('view-brand');
        Route::post('brand-status/{id}', [BrandController::class, 'toggleStatus']);
        Route::get('edit/{id}', [BrandController::class, 'edit']);
        Route::post('update/{id}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('delete/{id}', [BrandController::class, 'delete'])->name('brands.delete');
    });


    ## category  Routes
    Route::prefix('category')->group(function () {
        Route::get('add-category', [CategoryController::class, 'add'])->name('add-category');
        Route::post('store', [CategoryController::class, 'store']);
        Route::get('all-category', [CategoryController::class, 'view'])->name('view-category');
        Route::post('category-status/{id}', [CategoryController::class, 'toggleStatus']);
        Route::get('edit/{id}', [CategoryController::class, 'edit']);
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    ## product  Routes
    Route::prefix('product')->group(function () {
        Route::get('add-product', [ProductController::class, 'add'])->name('add-product');
        Route::post('store', [ProductController::class, 'store']);
        Route::get('all-product', [ProductController::class, 'view'])->name('view-products');
        Route::post('product-status/{id}', [ProductController::class, 'toggleStatus']);
        Route::get('edit/{id}', [ProductController::class, 'edit']);
        Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::post('delete-additional-image', [ProductController::class, 'deleteAdditionalImage'])->name('product.deleteAdditionalImage');

    });

    Route::prefix('order')->group(function(){
        Route::get('all-order', [OrdersController::class, 'view'])->name('all.orders');
        Route::get('view/{id}', [OrdersController::class, 'viewOrderDetails']);
        Route::put('order-status/{id}', [OrdersController::class, 'updateOrderStatus']);
        // Route::post('order-cancel/{id}', [OrderController::class, 'cancelOrder']);
        // Route::post('order-return/{id}', [OrderController::class,'returnOrder']);
        // Route::post('order-refund/{id}', [OrderController::class,'refundOrder']);
        // Route::post('order-return-request/{id}', [OrderController::class,'returnRequest']);
        // Route::get('order-return-request/{id}', [OrderController::class, 'viewReturnRequest']);
        // Route::post('order-return-request-accept/{id}', [OrderController::class, 'acceptReturnRequest']);
    });
});


## cache clear
Route::get('/clear', function() {
   
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    // Artisan::call('optimize');
 
    return "All caches cleared successfully!..!";
 
 });

 Route::fallback(function () {
    return view('errors.404');
 });

 Route::view('admin','errors.404');
 




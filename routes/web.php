<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
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

// Route::get('/view-order', function () {
//     return 'sadas';
// });
## featured products
Route::get('/', [ViewProductController::class, 'homePage'])->name('homePage');
Route::get('/productbuy/{slug}', [ViewProductController::class, 'show'])->name('product.show');


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('contact-us',[HomeController::class,'contactUs'])->name('contactus');
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

## authenticate routes
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [UserController::class, 'account'])->name('account');
    Route::get('/view-order', [UserController::class, 'viewOrder']);
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/update-password', [UserController::class, 'updatePassword']);


    Route::get('/checkout', [UserController::class, 'checkout']);


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
    });
});


## cache clear
Route::get('/clear', function() {
   
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    // Artisan::call('optimize');
 
    return "Cleared!";
 
 });




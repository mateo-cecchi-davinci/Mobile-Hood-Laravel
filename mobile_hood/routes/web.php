<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\PartnerMiddleware;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/partners', function () {
    return view('partners.home');
})->name('partners');

Auth::routes();

Route::prefix('admin')->middleware([Authenticate::class, AdminMiddleware::class])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/businesses', BusinessController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/locations', LocationsController::class);
});

Route::prefix('partner')->middleware([Authenticate::class, PartnerMiddleware::class])->group(function () {
    Route::get('/dashboard', [PartnerController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/menu/category', [PartnerController::class, 'category']);
    Route::post('/dashboard/menu/category-state', [PartnerController::class, 'categoryState']);
    Route::post('/dashboard/menu/product-state', [PartnerController::class, 'productState']);
    Route::post('/dashboard/menu/add-category', [PartnerController::class, 'addCategory']);
    Route::post('/dashboard/menu/edit-category', [PartnerController::class, 'editCategory']);
    Route::post('/dashboard/menu/delete-category', [PartnerController::class, 'deleteCategory']);
    Route::post('/dashboard/menu/add-product', [PartnerController::class, 'addProduct'])->name('add-product');
    Route::post('/dashboard/menu/edit-product', [PartnerController::class, 'editProduct'])->name('edit-product');
    Route::post('/dashboard/menu/delete-product', [PartnerController::class, 'deleteProduct'])->name('delete-product');

    Route::get('/dashboard/profile', [PartnerController::class, 'profile'])->name('partner-profile');
    Route::post('/dashboard/edit-frontPage', [PartnerController::class, 'editFrontPage'])->name('edit-frontPage');
    Route::post('/dashboard/edit-logo', [PartnerController::class, 'editLogo'])->name('edit-logo');
    Route::post('/dashboard/edit-name', [PartnerController::class, 'editName'])->name('edit-name');

    Route::get('/dashboard/hours', [PartnerController::class, 'hours'])->name('hours');
    Route::post('/dashboard/save-hours', [PartnerController::class, 'saveHours'])->name('save-hours');

    Route::get('/dashboard/orders', [PartnerController::class, 'orders'])->name('orders');
    Route::get('/dashboard/recent-orders', [PartnerController::class, 'recentOrders'])->name('recent-orders');

    Route::get('/dashboard/location', [PartnerController::class, 'location'])->name('location');
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::post('/business', [HomeController::class, 'business'])->name('business');

Route::get('/filter-products', [HomeController::class, 'filterProducts']);
Route::get('/filter-businesses', [HomeController::class, 'filterBusinesses']);
Route::post('/add-products', [CartController::class, 'addProducts']);
Route::post('/delete-cart-products', [CartController::class, 'delete']);
Route::post('/order', [OrderController::class, 'order'])->name('order');
Route::post('/user-orders', [OrderController::class, 'userOrders'])->name('user-orders');

Route::post('/mp_payment_notification', [OrderController::class, 'mp_payment_notification'])->name('mp_payment_notification');

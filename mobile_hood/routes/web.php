<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuisnessController;
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
    Route::resource('/buisnesses', BuisnessController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/locations', LocationsController::class);
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::post('/buisness', [HomeController::class, 'buisness'])->name('buisness');

Route::get('/filter-products', [HomeController::class, 'filterProducts'])->name('filter-products');

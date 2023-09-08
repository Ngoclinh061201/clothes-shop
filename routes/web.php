<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AboutUController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\IntroduceController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Client\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use \App\Http\Controllers\Client\BillController;

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
Route::get('seed-data-city', [BillController::class, 'seedDataCity']);


Route::get('checkout', [BillController::class, 'checkout']);
Route::post('place-order', [BillController::class, 'placeOrder']);
Route::post('get-districts-by-city', [BillController::class, 'getDistrictsByCity']);
// Route::get('/home', [HomeController::class, 'index']);
Route::get('/home', function () {
    return view('client.pages.home');
});

Route::get('categories/{slug}', [HomeController::class, 'searchByCategory']);
Route::post('add-cart', [CartController::class, 'addToCart']);
Route::get('detail-cart', [CartController::class, 'show']);
Route::get('remove-item-cart/{id}/{size}', [CartController::class, 'removeItemCart']);
Route::get('detail-product/{id}', [App\Http\Controllers\Client\ProductController::class, 'viewDetailProduct']);
Route::get('login-facebook/{social}', [SocialController::class, 'getInfor']);
Route::get('check-login-facebook/{social}', [SocialController::class, 'checkInfor']);
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/{slug}', [BlogController::class, 'show']);
});


Route::prefix('dashboard')->middleware(['auth.admin'])->group(function () {
    Route::get('/', [DashBoardController::class, 'index']);
    Route::POST('/cache-clear', [DashBoardController::class, 'cacheClear']);
});
Route::resource('category', CategoryController::class)->middleware(['auth']);
Route::resource('slide', SlideController::class)->middleware(['auth']);
Route::resource('product', ProductController::class)->middleware(['auth']);
Route::resource('post', PostController::class)->middleware(['auth']);

route::prefix('about-us')->group(function () {
    Route::get('/', [AboutUController::class, 'index']);
    Route::get('create', [AboutUController::class, 'create']);
    Route::post('store', [AboutUController::class, 'store']);
    Route::get('/{id}/edit', [AboutUController::class, 'edit']);
    Route::post('/{id}/update', [AboutUController::class, 'update']);
    Route::get('/{id}/delete', [AboutUController::class, 'destroy']);
});

Route::resource('bill-admin', App\Http\Controllers\Admin\BillController::class)->middleware(['auth']);


Route::get('test-email', [HomeController::class, 'testEmail']);
Route::prefix('introduce')->group(function () {
    Route::get('/', [IntroduceController::class, 'index']);
    Route::get('/{slug}', [IntroduceController::class, 'show']);
   
});
require __DIR__.'/auth.php';
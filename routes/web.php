<?php

use App\Http\Controllers\UserBlogController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\UserDealController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\UserForumController;
use App\Http\Controllers\UserJobController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    // Forgot session
    Session::forget('menu');
    // Store Session for Home Menu Active
    Session::put('menu', 'home');
    $products = [];
    $companies = [];
    $events = [];
    $data  = compact('products', 'companies', 'events');
    return view('welcome')->with($data);
})->name('home');

Route::prefix('company')->group(function () {
    Route::get('/', [UserCompanyController::class, 'viewCompanyList'])->name('company');
    Route::get('/{name}', [UserCompanyController::class, 'viewCompanyDetails'])->name('view.company');
});

Route::prefix('product')->group(function () {
    Route::get('/', [UserProductController::class, 'viewProductList'])->name('products');
    Route::get('/{name}', [UserProductController::class, 'viewProductDetails'])->name('view.product');
    Route::get('/add', [UserProductController::class, 'viewAddProduct'])->name('add.product');
});

Route::prefix('event')->group(function () {
    Route::get('/', [UserEventController::class, 'viewEventList'])->name('events');
    Route::get('/{name}', [UserEventController::class, 'viewEventDetails'])->name('view.event');
});

Route::prefix('blog')->group(function () {
    Route::get('/', [UserBlogController::class, 'viewBlogList'])->name('blogs');
    Route::get('/{name}', [UserBlogController::class, 'viewBlogDetails'])->name('view.blog');
});

Route::prefix('deal')->group(function () {
    Route::get('/', [UserDealController::class, 'viewDealList'])->name('deals');
    Route::get('/{name}', [UserDealController::class, 'viewDealDetails'])->name('view.deal');
});

Route::prefix('job')->group(function () {
    Route::get('/', [UserJobController::class, 'viewJobList'])->name('jobs');
    Route::get('/{name}', [UserJobController::class, 'viewJobDetails'])->name('view.job');
});

Route::prefix('forum')->group(function () {
    Route::get('/', [UserForumController::class, 'viewForumList'])->name('forum');
    Route::get('/{name}', [UserForumController::class, 'viewForumDetails'])->name('view.forum');
});

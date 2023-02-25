<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserManage;
use App\Http\Controllers\Category;
use App\Http\Controllers\ShowManage;
use App\Http\Controllers\BannerManage;
use App\Http\Controllers\Offer;
use App\Http\Controllers\OrderManage;
use App\Http\Controllers\SalesManagement;
use App\Http\Controllers\ShippingManage;
use App\Http\Controllers\SampleFileManage;
use App\Http\Controllers\FreeDownloadManage;
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

Route::get('login', [Authenticate::class, 'login'])->name('login');
Route::post('user-check', [Authenticate::class, 'userCheck'])->name('user-check');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [Dashboard::class, 'index']);
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');
    Route::get('logout', [Authenticate::class, 'logout'])->name('logout');
    Route::prefix('user')->group(function(){
        Route::match(['get','post'],'list', [UserManage::class, 'index'])->name('user-list');
        Route::get('add', [UserManage::class, 'add'])->name('user-add');
        Route::get('edit/{id}', [UserManage::class, 'add'])->name('user-edit');
        Route::post('get-user-list', [UserManage::class, 'ajaxDataTable'])->name('ajax-user-list');
    });
    Route::prefix('order')->group(function(){
        Route::match(['get','post'],'list', [OrderManage::class, 'index'])->name('order-list');
        Route::get('add', [OrderManage::class, 'add'])->name('order-add');
        Route::get('edit/{id}', [OrderManage::class, 'add'])->name('order-edit');
        Route::get('details/{id}', [OrderManage::class, 'details'])->name('order-details');
        Route::post('get-order-list', [OrderManage::class, 'ajaxDataTable'])->name('ajax-order-list');
    });
    Route::prefix('category')->group(function(){
        Route::match(['get','post'],'list', [Category::class, 'index'])->name('category-list');
        Route::get('add', [Category::class, 'add'])->name('category-add');
        Route::get('edit/{id}', [Category::class, 'add'])->name('category-edit');
        Route::get('ajax-category-list', [Category::class, 'ajaxDataTable'])->name('ajax-category-list');
        Route::get('ajax-show-list', [ShowManage::class, 'ajaxDataTable'])->name('ajax-show-list');
        Route::match(['get','post'],'show-list', [ShowManage::class, 'index'])->name('show-list');
        Route::get('show-add', [ShowManage::class, 'add'])->name('show-add');
        Route::get('show-edit/{id}', [ShowManage::class, 'add'])->name('show-edit');
    });
    Route::prefix('banner')->group(function(){
        Route::match(['get','post'],'list', [BannerManage::class, 'index'])->name('banner-list');
        Route::get('add', [BannerManage::class, 'add'])->name('banner-add');
        Route::get('edit/{id}', [BannerManage::class, 'add'])->name('banner-edit');
    });
    
    Route::prefix('offer')->group(function(){
        Route::match(['get','post'],'list', [Offer::class, 'index'])->name('offer-list');
        Route::get('add', [Offer::class, 'add'])->name('offer-add');
        Route::get('edit/{id}', [Offer::class, 'add'])->name('offer-edit');
    });
    Route::prefix('category-sale')->group(function(){
        Route::match(['get','post'],'list', [SalesManagement::class, 'index'])->name('category-sale-list');
        Route::get('add', [SalesManagement::class, 'add'])->name('category-sale-add');
        Route::get('edit/{id}', [SalesManagement::class, 'add'])->name('category-sale-edit');
    });
    Route::prefix('today-sale')->group(function(){
        Route::match(['get','post'],'list', [SalesManagement::class, 'todaySales'])->name('today-sale-list');
        Route::get('add', [SalesManagement::class, 'todaySaleAdd'])->name('today-sale-add');
        Route::get('edit/{id}', [SalesManagement::class, 'todaySaleAdd'])->name('today-sale-edit');
    });
    Route::prefix('shipping-cost')->group(function(){
        Route::post('save', [ShippingManage::class, 'index'])->name('shipping-cost-save');
        Route::get('add', [ShippingManage::class, 'add'])->name('shipping-cost-add');
    });
    Route::prefix('sample-file')->group(function(){
        Route::get('ajax-sample-file-list', [SampleFileManage::class, 'ajaxDataTable'])->name('ajax-sample-file-list');
        Route::match(['get','post'],'list', [SampleFileManage::class, 'index'])->name('sample-file-list');
        Route::get('add', [SampleFileManage::class, 'add'])->name('sample-file-add');
        Route::get('edit/{id}', [SampleFileManage::class, 'add'])->name('sample-file-edit');
    });
    Route::prefix('free-downloads')->group(function(){
        Route::get('ajax-free-downloads-list', [FreeDownloadManage::class, 'ajaxDataTable'])->name('ajax-free-downloads-list');
        Route::match(['get','post'],'list', [FreeDownloadManage::class, 'index'])->name('free-downloads-list');
        Route::get('add', [FreeDownloadManage::class, 'add'])->name('free-downloads-add');
        Route::get('edit/{id}', [FreeDownloadManage::class, 'add'])->name('free-downloads-edit');
    });
    
    Route::post('generic-status-change-delete', [Authenticate::class, 'genericStatusChange'])->name('generic-status-change-delete');
    Route::post('state-list-by-country-id', [Authenticate::class, 'stateListByCountryId'])->name('state-list-by-country-id');
});


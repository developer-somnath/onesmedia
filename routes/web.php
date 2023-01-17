<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserManage;
use App\Http\Controllers\Category;
use App\Http\Controllers\ShowManage;
use App\Http\Controllers\BannerManage;

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
    Route::post('generic-status-change-delete', [Authenticate::class, 'genericStatusChange'])->name('generic-status-change-delete');
    Route::post('state-list-by-country-id', [Authenticate::class, 'stateListByCountryId'])->name('state-list-by-country-id');
});


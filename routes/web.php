<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserManage;

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
    Route::post('generic-status-change-delete', [Authenticate::class, 'genericStatusChange'])->name('generic-status-change-delete');
    Route::post('state-list-by-country-id', [Authenticate::class, 'stateListByCountryId'])->name('state-list-by-country-id');
});


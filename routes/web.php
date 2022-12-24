<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Dashboard;

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
});


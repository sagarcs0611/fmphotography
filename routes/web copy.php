<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('guest')->group(function () {
//     Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
//     Route::get('/admin/register', [AuthController::class, 'register'])->name('register');

//     Route::post('/admin/register', [AuthController::class, 'store_register'])->name('register.store');
//     Route::post('/admin/login', [AuthController::class, 'do_login'])->name('do_login');
// });


// Route::middleware('auth')->group(function () {
//     Route::get('/admin/product', [AdminController::class, 'product'])->name('product');
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//     Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
//     Route::get('/admin/add-new-product', [AdminController::class, 'add_new_product'])->name('product.new');


// });

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/product', [AdminController::class, 'product'])->name('product');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
Route::get('/admin/register', [AuthController::class, 'register'])->name('register');

Route::post('/admin/register', [AuthController::class, 'store_register'])->name('register.store');
Route::post('/admin/login', [AuthController::class, 'do_login'])->name('do_login');

Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('/admin/add-new-product', [AdminController::class, 'view_add_new_product'])->name('product.new');
Route::post('/admin/add-new-product', [AdminController::class, 'add_new_product'])->name('add.new.product');



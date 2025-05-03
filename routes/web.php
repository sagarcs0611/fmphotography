<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/register', [AuthController::class, 'store_register'])->name('register.store');
    Route::post('/login', [AuthController::class, 'do_login'])->name('do_login');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/product', [AdminController::class, 'product'])->name('product');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/admin/add-new-product', [AdminController::class, 'view_add_new_product'])->name('product.new');
    Route::post('/admin/add-new-product', [AdminController::class, 'add_new_product'])->name('add.new.product');


    Route::get('/admin/get-edit-data', [AdminController::class, 'get_edit_data'])->name('edit.product.data');
    Route::post('/admin/get-edit-data', [AdminController::class, 'update_edit_data'])->name('update.product.data');

    Route::get('/admin/delete-product-data', [AdminController::class, 'delete_product_data'])->name('delete.product.data');

    Route::get('/admin/add-new-client', [AdminController::class, 'view_add_new_client'])->name('client.new');
    Route::post('/admin/add-new-client', [AdminController::class, 'add_new_client'])->name('client.add');

    Route::get('/admin/client-list', [AdminController::class, 'client_list'])->name('client.list');

    Route::get('/admin/manage-proposal', [AdminController::class, 'manage_proposal'])->name('proposal.manage');
    Route::post('/admin/create-proposal', [AdminController::class, 'create_proposal'])->name('proposal.create');

    Route::get('/admin/proposal-list', [AdminController::class, 'proposal_list'])->name('proposal.list');


    Route::get('/admin/get-package-details', [AdminController::class, 'get_package_details'])->name('package.details');


});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/proposal', [UserController::class, 'proposal_details'])->name('proposal.details');
});

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/admin/product', [AdminController::class, 'product'])->name('product');
// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
// Route::get('/admin/register', [AuthController::class, 'register'])->name('register');

// Route::post('/admin/register', [AuthController::class, 'store_register'])->name('register.store');
// Route::post('/admin/login', [AuthController::class, 'do_login'])->name('do_login');

// Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// Route::get('/admin/add-new-product', [AdminController::class, 'view_add_new_product'])->name('product.new');
// Route::post('/admin/add-new-product', [AdminController::class, 'add_new_product'])->name('add.new.product');


// Route::get('/admin/get-edit-data', [AdminController::class, 'get_edit_data'])->name('edit.product.data');
// Route::post('/admin/get-edit-data', [AdminController::class, 'update_edit_data'])->name('update.product.data');

// Route::get('/admin/delete-product-data', [AdminController::class, 'delete_product_data'])->name('delete.product.data');


// Route::get('/admin/add-new-client', [AdminController::class, 'view_add_new_client'])->name('client.new');
// Route::post('/admin/add-new-client', [AdminController::class, 'add_new_client'])->name('client.add');

// Route::get('/admin/client-list', [AdminController::class, 'client_list'])->name('client.list');

// Route::get('/admin/manage-proposal', [AdminController::class, 'manage_proposal'])->name('proposal.manage');

// Route::post('/admin/create-proposal', [AdminController::class, 'create_proposal'])->name('proposal.create');

<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdukController;
 
Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
 
Route::group(['middleware' => 'auth'], function () {
 
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('products', [ProductController::class, 'index'])->name('index');
    // Route::get('produk', [ProdukController::class, 'index'])->name('index');
    Route::resource('products', ProductController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::get('/', function () {
//     return view('welcome');
// });
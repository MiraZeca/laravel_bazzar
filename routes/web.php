<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WarehouseController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/exchange', function () {
    return view('exchange');
})->name('exchange');

Route::get('/about/{category?}', [AboutController::class, 'index'])->name('about');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('users.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/login/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/login/user', [LoginController::class, 'index'])->name('user');

Route::get('/products/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/products/products', [ProductController::class, 'index'])->name('products');
Route::post('/products/products', [ProductController::class, 'store'])->name('products.store');

Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/info', [ContactController::class, 'info'])->name('contact.info');
Route::post('/contact/{id}/answered', [ContactController::class, 'markAsAnswered'])->name('contact.answered');

Route::get('/admin/warehouse/{product_id}/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
Route::put('/admin/warehouse/{product_id}', [WarehouseController::class, 'update'])->name('warehouse.update');
Route::delete('/admin/warehouse/{product_id}', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');

// Route::post('/like/{product_id}', [LikeController::class, 'store'])->middleware('auth')->name('like');
Route::post('/product/{id}/like', [LikeController::class, 'toggle'])->name('product.like');
Route::get('/my-likes', [LikeController::class, 'myLikes'])->name('likes.my')->middleware('auth');


Route::post('/order/{product_id}', [OrderController::class, 'store'])->middleware('auth')->name('order');

Route::get('/admin/warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');

Route::get('/admin/warehouse/create', [WarehouseController::class, 'create'])->name('warehouse.create');

Route::post('/admin/warehouse', [WarehouseController::class, 'store'])->name('warehouse.store');

Route::post('/order/{product_id}', [OrderController::class, 'store'])->middleware('auth')->name('order');
Route::get('/my-oredrs', [OrderController::class, 'userOrders'])->middleware('auth')->name('user.orders');

Route::get('/admin/orders', [OrderController::class, 'adminOrders'])
    ->middleware('auth') 
    ->name('admin.orders');

Route::get('/admin/orders/{id}/approve', [OrderController::class, 'approve'])
    ->middleware('auth') 
    ->name('admin.approve');

Route::get('/admin/orders/{id}/reject', [OrderController::class, 'reject'])
    ->middleware('auth') 
    ->name('admin.reject');

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');


Route::get('/blog', [CommentController::class, 'index'])->name('blog.index');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

Route::get('/comment', [HomeController::class, 'showCommentForm'])->name('comment.form');
Route::post('/comment', [HomeController::class, 'storeComment'])->name('comment.store');

Route::post('/profile/upload', [UserController::class, 'uploadProfileImage'])->name('profile.image.upload');



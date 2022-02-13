<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;

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
Route::get('/register',[RegisterController::class,'register'])->name('register.index');
Route::post('/create',[RegisterController::class,'create'])->name('register.create');
Route::get('/login',[LoginController::class,'login'])->name('login.index');
Route::post('/check',[LoginController::class,'check'])->name('login.check');
Route::get('/logout',[LogoutController::class,'logout'])->name('logout');

Route::prefix('/')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('index');
    Route::get('/single-product/{slug}/{id}',[UserProductController::class,'singleProduct'])->name('product.singleProduct');
    Route::post('/product-review',[UserProductController::class,'productReview']);

});
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
Route::prefix('dashboard/category')->group(function(){
    Route::get('/index',[CategoryController::class,'index'])->name('category.index');
    Route::post('/create',[CategoryController::class,'create'])->name('category.create');
    Route::get('/show',[CategoryController::class,'show'])->name('category.show');
    Route::get('/trushed/{id}',[CategoryController::class,'moveTotrushed']);
    Route::get('/trushed',[CategoryController::class,'trushed'])->name('category.trushed');
    Route::get('/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
    Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/edit',[CategoryController::class,'editInsert'])->name('category.editInsert');
});

Route::prefix('dashboard/subcategory')->group(function(){
    Route::get('/index',[SubCategoryController::class,'index'])->name('subcategory.index');
    Route::post('/create',[SubCategoryController::class,'create'])->name('subcategory.create');
    Route::get('/show',[SubCategoryController::class,'show'])->name('subcategory.show');
    Route::get('/trushed/{id}',[SubCategoryController::class,'moveTotrushed']);
    Route::get('/trushed',[SubCategoryController::class,'trushed'])->name('subcategory.trushed');
    Route::get('/restore/{id}',[SubCategoryController::class,'restore']);
    Route::get('/delete/{id}',[SubCategoryController::class,'delete']);
    Route::get('/edit/{id}',[SubCategoryController::class,'edit'])->name('product.edit');
    // Route::post('/edit',[SubCategoryController::class,'editInsert']);
});


Route::prefix('dashboard/product')->group(function(){
    Route::get('/index',[DashboardProductController::class,'index'])->name('product.index');
    Route::post('/create',[DashboardProductController::class,'create'])->name('product.create');
    Route::get('/show',[DashboardProductController::class,'show'])->name('product.show');
    Route::get('/edit/{id}',[DashboardProductController::class,'edit'])->name('product.edit');
    Route::post('/update',[DashboardProductController::class,'update'])->name('product.update');
    Route::get('/subcategory/{id}',[DashboardProductController::class,'subCategory'])->name('product.subcategory');
    Route::get('/movetotrush/{id}',[DashboardProductController::class,'moveToTrush']);
    Route::get('/all-trush',[DashboardProductController::class,'allTrush'])->name('product.trush');
    Route::get('/restore/{id}',[DashboardProductController::class,'restore'])->name('product.restore');
    Route::get('/delete/{id}',[DashboardProductController::class,'delete'])->name('product.delete');
});
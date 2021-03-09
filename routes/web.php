<?php

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

//tes
Route::get('/', function () {
    return view('welcome');
})->name('landing-page');

Auth::routes();

// Apply role middleware
Route::middleware('role:admin')->group(function () {

    
    // Home Route
    Route::get('/home', 'HomeController@index')->name('home');

    // User Route
    Route::get('/user', 'UserController@index')->name('user');
    Route::post('/user/store', 'UserController@store')->name('user_store');
    
    // Member Route
    Route::get('/member', 'MemberController@index')->name('member');
    Route::put('/member/update/{id}', 'MemberController@update');
    Route::get('/member/destroy/{id}', 'MemberController@destroy');

    // Supplier Route
    Route::get('/supplier', 'SupplierController@index')->name('supplier');
    Route::put('/supplier/update/{id}', 'SupplierController@update');
    Route::get('/supplier/destroy/{id}', 'SupplierController@destroy');
    Route::put('/supplier/store', 'SupplierController@store')->name('supplier_store');
    
    // Product Route
    Route::get('/product', 'ProductController@index')->name('product');
    
    // Category Route
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::put('/category/update/{id}', 'CategoryController@update');
    Route::get('/category/destroy/{id}', 'CategoryController@destroy');
    Route::put('/category/store', 'CategoryController@store')->name('category_store');
    
});
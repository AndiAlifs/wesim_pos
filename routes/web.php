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
    Route::put('/user/update/{id}', 'UserController@update');
    Route::get('/user/destroy/{id}', 'userController@destroy');
    
    // Member Route
    Route::get('/member', 'MemberController@index')->name('member');
    Route::put('/member/update/{id}', 'MemberController@update')->name('update_member');
    Route::get('/member/destroy/{id}', 'MemberController@destroy')->name('delete_member');
    Route::put('/member/store', 'MemberController@store')->name('create_member');

    // Supplier Route
    Route::get('/supplier', 'SupplierController@index')->name('supplier');
    Route::put('/supplier/update/{id}', 'SupplierController@update')->name('update_supplier');
    Route::get('/supplier/destroy/{id}', 'SupplierController@destroy')->name('delete_supplier');
    Route::put('/supplier/store', 'SupplierController@store')->name('supplier_store');
    
    // Product Route
    Route::get('/product', 'ProductController@index')->name('product');
    Route::post('/product/store', 'ProductController@store')->name('product_store');
    Route::get('/product/destroy/{id}', 'ProductController@destroy');
    
    // Category Route
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::put('/category/update/{id}', 'CategoryController@update');
    Route::get('/category/destroy/{id}', 'CategoryController@destroy');
    Route::put('/category/store', 'CategoryController@store')->name('category_store');
    
});

Route::get('/cashier', 'cashier\CashierController@index')->name('cashier');
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
});

Auth::routes();

// Home Route
Route::get('/home', 'HomeController@index')->name('home');

// User Route
Route::get('/user', 'UserController@index')->name('user');

// Member Route
Route::get('/member', 'MemberController@index')->name('member');

// Supplier Route
Route::get('/supplier', 'SupplierController@index')->name('supplier');
Route::put('/supplier/update/{id}', 'SupplierController@update');
Route::get('/supplier/destroy/{id}', 'SupplierController@destroy');
Route::put('/supplier/store', 'SupplierController@store')->name('supplier_store');

// Product Route
Route::get('/product', 'ProductController@index')->name('product');

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

Route::middleware('role:3')->group(
    function() {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/user', 'UserController@index')->name('user');
        Route::get('/member', 'MemberController@index')->name('member');
        Route::get('/supplier', 'SupplierController@index')->name('supplier');
        Route::get('/product', 'ProductController@index')->name('product');
    });

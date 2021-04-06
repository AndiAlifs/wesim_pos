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

// Can accessed by admin and store manager
Route::middleware('role:admin_owner')->group(function () {
    // Home Route
    Route::get('/home', 'HomeController@index')->name('home');

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

    // finance route
    Route::get('/finance', 'FinanceController@index')->name('finance');
    Route::post('/finance/store', 'FinanceController@store')->name('finance_store');

    // inventory route
    Route::get('/inventory', 'InventoryController@index')->name('inventory');
    Route::get('/inventory/confirm_ship/{id}', 'InventoryController@confirm_ship');
    Route::put('/inventory/update/{id}', 'InventoryController@update');

    //report route
    Route::get('/report', 'ReportController@index')->name('report');
    Route::get('/report/visitor', 'ReportController@indexVisitor')->name('report_visitor');
    Route::get('/report/finance', 'ReportController@indexfinance')->name('report_finance');

    //report route
    Route::get('/purchase', 'PurchaseController@index')->name('purchase');
    Route::get('/purchase_cashier', 'PurchaseController@purchase_cashier')->name('purchase_cashier');
});

// Only for admin
Route::middleware('role:admin')->group(function () {

    // Discount Route
    Route::get('/discount', 'DiscountController@index')->name('discount');
    Route::put('/discount/update', 'DiscountController@update')->name('discount_update');
    Route::get('/discount/destroy/{id}', 'DiscountController@destroy')->name('discount_destroy');
});

Route::middleware('role:owner')->group(function () {

    // User Route
    Route::get('/user', 'UserController@index')->name('user');
    Route::post('/user/store', 'UserController@store')->name('user_store');
    Route::put('/user/update/{id}', 'UserController@update');
    Route::get('/user/destroy/{id}', 'userController@destroy');
});

Route::middleware('role:cashier')->group(function () {

    // cashier route
    Route::get('/cashier', 'cashier\CashierController@index')->name('cashier');

    // ----------------- cashier ---------------
    // transaction
    Route::post('/cashier/pay_transaction/', 'cashier\CashierController@pay_transaction')->name('pay_transaction');

    // hold
    Route::post('/cashier/add_new_transaction/', 'cashier\CashierController@add_new_transaction')->name('add_new_transaction');

    // menu
    Route::get('/cashier/load_product/', 'cashier\CashierController@load_product')->name('load_product');
    Route::get('/cashier/filter_category/{id}', 'cashier\CashierController@filter_category')->name('filter_category');
    Route::get('/cashier/search_box/', 'cashier\CashierController@search_box')->name('search_box');

    // cart
    Route::post('/cashier/load_cart/', 'cashier\CashierController@load_cart')->name('load_cart');
    Route::post('/cashier/delete_item/', 'cashier\CashierController@delete_item')->name('delete_item');
    Route::get('/cashier/delete_cart/', 'cashier\CashierController@delete_cart')->name('delete_cart');

    // modal
    Route::post('/cashier/get_modal_data/', 'cashier\CashierController@get_modal_data')->name('get_modal_data');
    Route::post('/cashier/add_to_cart/', 'cashier\CashierController@add_to_cart')->name('add_to_cart');
    // ----------------- end cashier --------------


    // ----------------- transactions ------------
    Route::get('/cashier/transaction_today', 'cashier\TransactionController@index')->name('transaction_today');
    Route::get('/cashier/detail_transaction', 'cashier\TransactionController@detail_transaction')->name('detail_transaction');
    // ----------------- end transactions --------

});
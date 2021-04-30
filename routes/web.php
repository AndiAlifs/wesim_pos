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
    Route::get('/report/selling', 'ReportController@indexselling')->name('report_selling');
    Route::get('/report/purchase', 'ReportController@indexpurchase')->name('report_purchase');

    //purchase route
    Route::get('/purchase', 'purchaseController@index')->name('purchase');

    //selling route
    Route::get('/selling', 'sellingController@index')->name('selling');

    //preorder route
    Route::get('/preorder', 'PreorderController@index')->name('preorder');
    Route::get('/preorder_cashier', 'preorderController@preorder_cashier')->name('preorder_cashier');
    Route::post('/preorder/add_new_po/', 'preorderController@add_new_po')->name('add_new_po');
    Route::post('/preorder/get_modal_data_po/', 'preorderController@get_modal_data_po')->name('get_modal_data_po_po');
    Route::post('/preorder/add_to_cart_po/', 'preorderController@add_to_cart_po')->name('add_to_cart_po');
    Route::post('/preorder/load_cart_po/', 'preorderController@load_cart_po')->name('load_cart_po');
    Route::post('/preorder/delete_item_po/', 'preorderController@delete_item_po')->name('delete_item_po');
    Route::post('/preorder/order/', 'preorderController@order')->name('order');
    Route::get('/preorder/search_box_po', 'preorderController@search_box_po')->name('search_box_po');
    Route::get('/preorder/destroy/{id}', 'preorderController@destroy')->name('delete_po');
    Route::post('/preorder/confirm_ship/', 'preorderController@confirm_ship')->name('confirm_ship');

    //procut price
    Route::get('/price', 'PriceController@index_price')->name('price');
    Route::put('/price/update', 'PriceController@update')->name('price_update');
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
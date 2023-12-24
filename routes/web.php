<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
//    return view('auth.login');
//});


Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@index')->name('index');

Route::middleware('auth')->group(function(){
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');

    //pitches
Route::get('/create-pitches', 'admin\PitchesController@create')->name('create-pitches');
Route::post('/store-pitches', 'admin\PitchesController@store')->name('store-pitches');

Route::get('/admin/pitches', 'admin\PitchesController@admin_pitches')->name('admin-pitches');
Route::get('/admin/detail/order/{id}', 'admin\PitchesController@detail_order')->name('admin-detail-order');

// product
Route::get('/add-product', 'admin\ProductController@create')->name('add-product');
Route::post('/store-product', 'admin\ProductController@store')->name('store-product');
Route::get('/list-product', 'admin\ProductController@list')->name('list-product');
Route::get('/delete-product/{id}', 'admin\ProductController@delete')->name('delete-product');
Route::get('/edit-product/{id}', 'admin\ProductController@edit')->name('edit-product');
Route::post('/update-product/{id}', 'admin\ProductController@update')->name('update-product');

Route::get('admin/user/list-user','admin\AdminController@list')->name('admin/user/list-user');
Route::get('admin/user/add-user','admin\AdminController@add')->name('admin/user/add-user');
Route::post('admin/user/store','admin\AdminController@store');
Route::get('admin/user/delete/{id}','admin\AdminController@delete')->name('admin/user/delete');
Route::get('admin/user/action','admin\AdminController@action');
Route::get('admin/user/edit/{id}','admin\AdminController@edit')->name('admin/edit');
Route::post('admin/user/update/{id}','admin\AdminController@update')->name('admin/update');

//update_order
Route::post('update_admin_order/{id}','admin\AdminOderController@update_order')->name('update_order');

//admin
Route::get('/admin/dashboard', 'admin\DashboardController@dashboard')->name('dashboard');
Route::get('detail_dashboard/{id}','admin\DashboardController@detail')->name('detail');
Route::get('/admin/dashboard2', 'admin\DashboardController@dashboard2')->name('dashboard2');

Route::get('/admin/list-pitches', 'admin\PitchesController@listPitches')->name('list-pitches');

Route::get('/admin/detail/pitches/{id}', 'admin\PitchesController@adminDetailPitches')->name('admin-list-pitches');

Route::get('/edit/pitches/{id}', 'admin\PitchesController@editPitches')->name('edit-pitches');
Route::get('/add/soccer-schedule/{id}', 'admin\PitchesController@addSchedule')->name('add-soccer-schedule');
// Route::get('/get-soccer-schedule/{id}', 'admin\PitchesController@getScheduleForPitches')->name('get-schedules-for-pitches');
Route::post('/add-soccer-schedule', 'admin\PitchesController@addScheduleForPitches')->name('add-schedules-for-pitches');
Route::post('/edit-soccer-schedule', 'admin\PitchesController@editScheduleForPitches')->name('edit-schedules-for-pitches');

});

Route::post('/create-oder', 'admin\PitchesController@create_oder')->name('create-oder');
Route::get('/home', 'HomeController@index')->name('index');
Route::get('/service', 'HomeController@service')->name('service');
Route::get('/product', 'HomeController@product')->name('product');
Route::get('/detail-pitches/{id}', 'HomeController@detail')->name('detail-pitches');
Route::get('add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('add.to.cart');

Route::get('/show', 'HomeController@show')->name('show');
Route::get('/test', 'admin\UserController@create')->name('test');
Route::post('/store', 'admin\UserController@store')->name('store');

//pitches
// Route::get('/create-pitches', 'admin\PitchesController@create')->name('create-pitches');
// Route::post('/store-pitches', 'admin\PitchesController@store')->name('store-pitches');
// Route::post('/create-oder', 'admin\PitchesController@create_oder')->name('create-oder');
Route::post('/search-pitches', 'admin\PitchesController@search')->name('search-pitches');
Route::get('/get-soccer-schedule/{id}', 'admin\PitchesController@getScheduleForPitches')->name('get-schedules-for-pitches');

//district
Route::post('select_district','admin\PitchesController@district')->name('district');
Route::post('select_commune','admin\PitchesController@commune')->name('commune');


Route::get('/checkout/pitches', 'admin\PitchesController@checkout')->name('checkout-pitches');

Route::get('/checked/{id}', 'admin\PitchesController@checked')->name('checked-pitches');

Route::post('/order/pitches', 'admin\PitchesController@orderPitches')->name('order-pitches');


Route::post('/pay/{id}', 'admin\PitchesController@pay')->name('pay');

Route::get('/admin/edit/{id}', 'admin\PitchesController@edit')->name('admin-edit-pitches');

Route::post('/admin/store_pitches/{id}', 'admin\PitchesController@store_pitches')->name('admin-store-pitches');


Route::get('cart/show','admin\CartController@show')->name('cart/show');
Route::get('cart/add/{id}','admin\CartController@add')->name('cart/add');
Route::get('cart/remove/{rowId}','admin\CartController@remove')->name('cart/remove');
Route::get('cart/destroy','admin\CartController@destroy')->name('cart/destroy');
Route::post('cart/action','admin\CartController@action')->name('cart/action');
Route::post('cart/action2/{id}','admin\CartController@action2')->name('cart/action2');
Route::get('cart/checkout','admin\CheckoutController@checkout_add')->name('cart/checkout');
Route::post('checkout/action','admin\CheckoutController@checkout_action')->name('checkout/action');
Route::get('product/show/{id}','admin\ProductController@detail_product')->name('product/show');
// chức năng tìm kiếm bằng ajax
Route::get('search', 'SearchController@getSearch');
Route::post('search/name', 'SearchController@getSearchAjax')->name('search');
Route::post('search/name/product', 'SearchController@getSearchProductAjax')->name('searchproduct');
//quanlytheodanhmuc
Route::get('product_cat','product_catController@product_cat')->name('admin/product/product_cat');
Route::post('product_cat/add','product_catController@addproduct_cat')->name('admin/product/addproduct_cat');

//district
Route::post('select_district','admin\CheckoutController@district')->name('district');
Route::post('select_commune','admin\CheckoutController@commune')->name('commune');
//buynow
Route::get('mua-ngay/{product_name}.html','admin\BuynowController@buynow')->name('buynow');
Route::post('checkout/action2','admin\BuynowController@checkout_action2')->name('checkout/action2');
//num-order
Route::post('num_order','CheckoutController@num_order')->name('num_order');
//admin order
Route::get('admin_order/{id}','admin\AdminOderController@admin_order')->name('admin_order');

Route::resource('coupon','admin\CouponController');

// coupon
Route::post('check-coupon', 'admin\CouponController@checkCoupon')->name('check/coupon');
Route::get('delete-coupon', 'admin\CouponController@delete')->name('delete/coupon');

Route::get('list-filter','ProductController@list_filter')->name('list-filter');
Route::post('list-filter-products','ProductController@list_filter_products')->name('list-filter-products');


//payment
Route::post('/vnpay', 'HomeController@PaymentVNPay')->name('vnpay');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.home');
});

// Template Master
Route::resource('/', 'App\Http\Controllers\DashboardController');
Route::resource('/allproducts', 'App\Http\Controllers\AllProductsController');
// ============================================================================

// Shops View
use App\Http\Controllers\DashboardController;
Route::get('/shopdetail/{id}', 'App\Http\Controllers\DashboardController@productDetail')->name('shopdetail.index');
Route::get('contact', [DashboardController::class, 'indexContact'])->name('dashboard.contact');
// RajaOngkir routes
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentcustomerController;
use App\Http\Controllers\DeliveriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PurchaseTransactionsController;
use App\Http\Controllers\ProductsController;

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('get-city', [CheckoutController::class, 'getCity'])->name('checkout.getCity');
    Route::get('get-shipping-cost', [CheckoutController::class, 'getShippingCost'])->name('checkout.getShippingCost');
    Route::get('checkout-payment/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/order', [CheckoutController::class, 'order'])->name('checkout.order');

    Route::get('payment', [PaymentcustomerController::class, 'index'])->name('checkout-payment.index');
    Route::get('/get-snap-token/{paymentId}', [PaymentcustomerController::class, 'getSnapToken']);
    Route::resource('carts', 'App\Http\Controllers\CartsController');
    Route::resource('wishlists', 'App\Http\Controllers\WishlistsController');
    Route::put('/carts/{id}/updateCart', [CartsController::class, 'updateCart'])->name('carts.updateCart');    
    Route::post('/shopdetail/review', 'App\Http\Controllers\DashboardController@store')->name('reviews.store');

    // sidebar
    Route::post('/confirm-order/{delivery}', [DeliveriesController::class, 'confirmOrder'])->name('confirm.order');
    Route::get('orderstatus', [DeliveriesController::class, 'indexCustomer'])->name('sidebarpage.orderstatus');
    Route::get('reviewproduct', [ProductsController::class, 'show'])->name('sidebarpage.reviewproduct');
    // Route::get('unpaidorder', [PaymentcustomerController::class, 'indexSidebar'])->name('sidebarpage.unpaidorder');
    Route::resource('unpaidordercustomer', 'App\Http\Controllers\UnpaidController');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
});

// ============================================================================


// View Master(admin)
Route::middleware(['admin.auth'])->group(function () {
    Route::resource('admin', 'App\Http\Controllers\AdminController');
    Route::resource('product_categories', 'App\Http\Controllers\ProductCategoriesController');
    Route::resource('products', 'App\Http\Controllers\ProductsController');
    Route::resource('orders', 'App\Http\Controllers\OrdersController');
    Route::get('unpaidorder', [OrdersController::class, 'indexUnpaid'])->name('unpaidorder.index');
    Route::resource('order_details', 'App\Http\Controllers\OrderDetailsController');
    Route::resource('customers', 'App\Http\Controllers\CustomersController');
    Route::resource('payments', 'App\Http\Controllers\PaymentsController');
    Route::resource('discounts-admin', 'App\Http\Controllers\DiscountsController');
    Route::resource('deliveries', 'App\Http\Controllers\DeliveriesController');
    Route::resource('product_reviews-admin', 'App\Http\Controllers\ProductReviewsController');
    Route::resource('employees', 'App\Http\Controllers\EmployeesController');
    Route::resource('suppliers', 'App\Http\Controllers\SuppliersController');
    Route::resource('purchasetransactions', 'App\Http\Controllers\PurchaseTransactionsController');
    Route::get('/order-data', [AdminController::class, 'getOrderData']);


    Route::get('/report/pdf', [ReportController::class, 'generatePDF'])->name('report.pdf');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/purchase-transactions/pdf', [PurchaseTransactionsController::class, 'generatePDF'])->name('purchase_transactions.pdf');
    Route::get('/purchase-transactions', [PurchaseTransactionsController::class, 'indexReport'])->name('purchase_transactions.index');
    Route::post('/purchasetransactions/import', [PurchaseTransactionsController::class, 'import'])->name('purchasetransactions.import');
    Route::get('export-purchase-transactions', [PurchaseTransactionsController::class, 'export'])->name('purchasetransactions.export');

});

// ================================================================================================

// Auth
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showUserRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register.post');
Route::get('/admin-login', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin-login', 'App\Http\Controllers\Auth\LoginController@adminLogin')->name('admin.login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();
// ===================================================================================================================




Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('home');



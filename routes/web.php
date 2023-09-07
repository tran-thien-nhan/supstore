<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\RevenueChartController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NewsletterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/tim-kiem', [HomeController::class, 'search']);
Route::get('/customer-information', [HomeController::class, 'customer_information']);
Route::put('/update-customer/{customerId}', [HomeController::class, 'updateCustomer'])->name('update_customer');

Route::put('/update-customer-password/{customerId}', [HomeController::class, 'updateCustomerPassword'])->name('update_customer_password');

Route::get('/change-password', [HomeController::class, 'showChangePasswordForm'])->name('change_password');
Route::post('/change-password/{customer_id}', [HomeController::class, 'changePassword'])->name('update_password');

Route::get('/cart-history', [HomeController::class, 'cart_history']);

// danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham', [CategoryProduct::class, 'show_all_category_product']);
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham', [CategoryProduct::class, 'show_all_brand_product']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [CategoryProduct::class, 'show_brand_home']);
Route::get('/danh-muc-bai-viet', [CategoryProduct::class, 'show_all_blog']);
Route::get('/danh-muc-bai-viet/{blog_category_id}', [CategoryProduct::class, 'show_blog_by_category']);

//backend (admin)
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-login', [AdminController::class, 'AdminLogin']);

Route::get('/create-account', [AdminController::class, 'showCreateAccountForm'])->name('create.account');
Route::post('/create-account', [AdminController::class, 'createAccount'])->name('post.create.account');

//category-product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

//trang product-info
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product']);

//brand-product
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);

Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);

//product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

Route::get('/all-product/category-product/{category_id}', [ProductController::class, 'all_product_by_category']);
Route::get('/all-product/brand-product/{brand_id}', [ProductController::class, 'all_product_by_brand']);

Route::get('/all-product/filter-by-date', [ProductController::class, 'filter_by_date'])->name('filterData');
Route::get('/search_product', [ProductController::class, 'search_product'])->name('admin.product.all_product');


//cart
Route::post('/save-cart/{product_id}', [CartController::class, 'save_cart'])->name('cart.save_cart');
Route::get('/show-cart', [CartController::class, 'show_cart'])->name('cart.show_cart');
Route::get('/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');

//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::post('/login-customer-phone', [CheckoutController::class, 'login_customer_phone']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);

//order
//Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/manage-order', [CheckoutController::class, 'manage_order'])->name('manage_order');
Route::post('/manage-order/filter', [CheckoutController::class, 'filterOrders'])->name('filter_orders');
Route::get('/view-order/{order_id}', [CheckoutController::class, 'view_order']);
Route::get('/delete-order/{order_id}', [CheckoutController::class, 'delete_order']);
Route::get('/assign-shipper/{order_id}', [OrderController::class, 'showAssignShipperForm']);
Route::post('/assign-shipper/{order_id}', [OrderController::class, 'assignShipper']);

//send gmail
// Route::get('/send-mail',[SendMailController::class,'index']);
Route::get('/send-mail', [SendMailController::class, 'sendMail'])->name('mail.send');

//Login facebook
Route::get('/auth/facebook', [LoginController::class, 'login_facebook']);
Route::get('/auth/facebook/callback', [LoginController::class, 'callback_facebook']);

//Login google admin
Route::get('/auth/google', [LoginController::class, 'login_google']);
Route::get('auth/google/callback', [LoginController::class, 'callback_google']);

// //Login google customer
// Route::get('/auth/google', [LoginController::class, 'login_google_customer']);
// Route::get('auth/google/callback', [LoginController::class, 'callback_google_customer']);

//coupon
Route::post('/check-coupon', [CartController::class, 'check_coupon'])->name('check.coupon');
Route::get('/insert-coupon', [CouponController::class, 'insert_coupon']);
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);
Route::post('/insert-coupon-code', [CouponController::class, 'insert_coupon_code']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);
Route::get('/unset-coupon', [CouponController::class, 'unset_coupon'])->name('unset.coupon');
Route::get('/edit-coupon/{coupon_id}', [CouponController::class, 'edit_coupon']);
Route::post('/save-coupon', [CouponController::class, 'save_coupon']);
Route::post('/update-coupon/{coupon_id}', [CouponController::class, 'update_coupon']);
Route::get('/unactive-coupon/{coupon_id}', [CouponController::class, 'unactive_coupon']);
Route::get('/active-coupon/{coupon_id}', [CouponController::class, 'active_coupon']);
Route::get('/create-batch-coupon', [CouponController::class, 'createBatchCoupon'])->name('create-batch-coupon');
Route::post('/store-batch-coupon', [CouponController::class, 'storeBatchCoupon'])->name('store-batch-coupon');

//blog
Route::get('/add-blog', [BlogController::class, 'add_blog']);
Route::get('/all-blog', [BlogController::class, 'all_blog']);
Route::get('/all-blog/category-blog/{category_id}', [BlogController::class, 'showBlogsByCategory']);
Route::get('/all-blog-category', [BlogController::class, 'all_blog_category']);
Route::post('/save-blog', [BlogController::class, 'save_blog']);

Route::get('/unactive-blog/{blog_id}', [BlogController::class, 'unactive_blog']);
Route::get('/active-blog/{blog_id}', [BlogController::class, 'active_blog']);

Route::get('/add-blog-category', [BlogController::class, 'add_category_blog']);
Route::get('/edit-category-blog/{blog_category_id}', [BlogController::class, 'edit_category_blog']);

Route::get('/unactive-category-blog/{blog_category_id}', [BlogController::class, 'unactive_category_blog']);
Route::get('/active-category-blog/{blog_category_id}', [BlogController::class, 'active_category_blog']);

Route::post('/save-category-blog', [BlogController::class, 'save_category_blog']);
Route::get('/edit-blog/{blog_id}', [BlogController::class, 'edit_blog']);
Route::post('/update-blog/{blog_id}', [BlogController::class, 'update_blog']);
Route::get('/delete-blog/{blog_id}', [BlogController::class, 'delete_blog']);
Route::post('/update-category-blog/{blog_category_id}', [BlogController::class, 'update_category_blog']);
Route::get('/delete-category-blog/{blog_category_id}', [BlogController::class, 'delete_category_blog']);

Route::get('/chi-tiet-bai-viet/{blog_id}', [BlogController::class, 'show_blog_details']);

//update order status
Route::get('/edit-order-status/{order_id}', [OrderController::class, 'edit_order_status']);
Route::post('/save-order-status', [OrderController::class, 'save_order_status']);
Route::post('/update-order-status/{order_id}', [OrderController::class, 'update_order_status']);

//comment
Route::get('/admin/comments', [CommentController::class, 'index'])->name('admin.comments.index');
Route::post('/submit-comment', [CommentController::class, 'store'])->name('submit.comment');
// Route::put('/admin/comments/approve/{id}', [CommentController::class, 'approveComment'])->name('admin.comments.approve');
// Route::delete('/admin/comments/delete/{id}', [CommentController::class, 'deleteComment'])->name('admin.comments.delete');

Route::get('/approve-comment/{id}', [CommentController::class, 'approveComment'])->name('approve.comment');
Route::get('/delete-comment/{id}', [CommentController::class, 'deleteComment'])->name('delete.comment');

// chart
Route::get('/dashboard', [RevenueChartController::class, 'index'])->name('revenue.chart');

//employees
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/edit-employee/{admin_id}', [EmployeeController::class, 'editEmployee']);
Route::post('/update-employee/{admin_id}', [EmployeeController::class, 'updateEmployee']);
Route::get('/delete-employee/{admin_id}', [EmployeeController::class, 'deleteEmployee']);
Route::get('/filter-employees', [EmployeeController::class, 'filterEmployees'])->name('filter-employees');
Route::get('/search-employees', [EmployeeController::class, 'searchEmployees'])->name('search-employees');
Route::get('/filter-employees-by-district', [EmployeeController::class, 'filterEmployeesByDistrict'])->name('filter-employees-by-district');

//newsletter
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');
Route::get('/list-subscribed-emails', [NewsletterController::class, 'listSubscribedEmails'])->name('listSubscribedEmails');
Route::get('/compose-email', [NewsletterController::class, 'composeEmail'])->name('composeEmail');
Route::post('/send-bulk-email', [NewsletterController::class, 'sendBulkEmail'])->name('sendBulkEmail');


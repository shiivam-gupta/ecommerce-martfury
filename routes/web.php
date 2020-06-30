<?php

use App\Events\SendNotificationUser;
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

/* Front End Routes */

Route::get('/', 'HomeController@index')->name('index');
Route::get('/user-login', 'MyAccountController@index')->name('account.login');
Route::get('/user-register', 'MyAccountController@index')->name('account.register');
Route::get('/forgot-password', 'MyAccountController@forgotPassword')->name('forgot-password');
Route::post('attempt-login', 'MyAccountController@attemptlogin')->name('attempt-login');
Route::post('attempt-register', 'MyAccountController@attemptRegister')->name('attempt-register');
Route::post('/payment-response','PaymentResponseController@paymentResponse')->name('payment-response');
Route::get('/payment-success','PaymentResponseController@success')->name('payment-success');
Route::get('/payment-failed','PaymentResponseController@failed')->name('payment-failed');
Route::get('about-us', 'HomeController@aboutUs')->name('about-us');
Route::get('contact-us', 'HomeController@contactUs')->name('contact-us');

Route::get('policy', 'HomeController@policy')->name('policy');
Route::get('term-condition', 'HomeController@termCondition')->name('term-ondition');
Route::get('shipping', 'HomeController@shipping')->name('shipping');
Route::get('return', 'HomeController@return')->name('return');
Route::get('faqs', 'HomeController@faqs')->name('faqs');

Route::post('contact-us-save', 'HomeController@contactUsSave')->name('contact-us.save');
Route::get('/search-product', 'HomeController@searchProduct')->name('search-product');
Route::post('get-products', 'HomeController@getProducts')->name('get-products');
Route::get('product-detail/{slug?}', 'ProductController@index')->name('product-detail');
Route::post('news-letter', 'MyAccountController@newsLetter')->name('newsLetter');
Route::get('/my-product-view/{id?}', 'ProductController@myProductView')->name('my-product-view');
Route::get('/my-product-view/{id?}', 'ProductController@myProductView')->name('my-product-view');

// add to cart
Route::post('add-to-cart/{id}/{quantity?}', 'ProductController@addToCart')->name('add-to-cart');
Route::get('add-to-compare/{id}', 'ProductController@addToCompare')->name('add-to-compare');
Route::get('shopping-cart', 'ProductController@shoppingCart')->name('shopping-cart');
Route::get('/my-cart/{id?}', 'ProductController@myCart')->name('my-cart');
Route::post('/my-cart-update', 'ProductController@myCartUpdate')->name('my-cart-update');
Route::get('compare-item', 'ProductController@compareItem')->name('compare-item');
Route::get('/compare-item-remove/{id?}', 'ProductController@compareItemRemove')->name('compare-item-remove');
// add to cart

Route::middleware(['customer'])->group(function () {
    Route::get('my-profile', 'MyAccountController@myProfile')->name('my-profile');
    Route::post('my-profile-update', 'MyAccountController@MyProfileUpdate')->name('my-profile-update');
    Route::get('my-orders', 'MyAccountController@myOrders')->name('my-orders');
    Route::get('my-orders-details/{transaction_id?}', 'MyAccountController@myOrdersDetails')->name('my-orders-details');
    Route::get('/my-wishlist/{id?}', 'MyAccountController@myWishlist')->name('my-wishlist');
    Route::get('my-wishlist-product', 'MyAccountController@myWishlistProduct')->name('my-wishlist-product');
    Route::get('my-resetpass', 'MyAccountController@myresetPass')->name('my-resetpass');
    Route::post('my-resetpass-update', 'MyAccountController@myresetPassUpdate')->name('my-resetpass-update');   
    Route::get('my-reviews', 'MyAccountController@myReviews')->name('my-reviews');
    Route::get('logout', 'MyAccountController@Logout')->name('logout');
    Route::get('/get-state', 'MyAccountController@getState')->name('getstate');
    Route::get('/get-city', 'MyAccountController@getCity')->name('getcity');
    Route::post('/address-update', 'ProductController@addressUpdate')->name('address-update');

    Route::post('apply-coupon', 'PaymentController@applyCoupon')->name('apply-coupon');

    Route::get('/checkout', 'ProductController@checkout')->name('checkout');
    Route::post('/payment', 'PaymentController@payment')->name('payment');
    

    Route::post('my-reviews-save', 'MyAccountController@myReviewsSave')->name('my-reviews-save');

    Route::get('/get-state-checkout', 'ProductController@getState')->name('getstateCheckout');
    Route::get('/get-city-Checkout', 'ProductController@getCity')->name('getcityCheckout');
});

/* Admin Login Routes */
Route::group(['namespace' => 'Auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'LoginController@loginAdmin')->name('admin.login');
    Route::post('/', 'LoginController@loginAdminCheck')->name('admin.login.post');
    
});

Route::group(['namespace' => 'BackEnd\Admin', 'prefix' => 'admin'], function () {

    Route::get('/get-state', 'AdminController@getState')->name('admin.getstate');
    Route::get('/get-city', 'AdminController@getCity')->name('admin.getcity');

    /* Middleware to only access Logged In routes Only*/
    Route::middleware(['auth'])->group(function () {

        /* Middleware to only access Admin routes Only*/
        Route::middleware(['admin'])->group(function () {
            Route::get('/dashboard', 'AdminController@adminDashboard')->name('admin.dashboard');
            
            Route::get('/get-subcat', 'AdminController@getSubcat')->name('admin.getsubcat');
            Route::get('/get-childcat', 'AdminController@getChildcat')->name('admin.getchildcat');


            Route::get('/logout', 'AdminController@logout')->name('admin.logout');
            Route::get('/users/status/{id?}', 'UserController@changeStatus')->name('admin.user.status');
            Route::get('/attr-master/status/{id?}', 'AttrMasterController@changeStatus')->name('admin.attrmaster.status');
            Route::get('/brand/status/{id?}', 'BrandController@changeStatus')->name('admin.brand.status');

        //========================= Category Managment=======================//
            ///==================  Category========================//
            Route::get('category','CategoryManageController@category')->name('category');
            Route::get('add-category','CategoryManageController@addCategory')->name('add-category');
            Route::get('edit-category/{id}','CategoryManageController@editCategory')->name('edit-category');
            Route::post('save-category','CategoryManageController@saveCategory')->name('save-category');
            Route::get('delete-category/{id}','CategoryManageController@deleteCategory')->name('delete-category');
            Route::post('category-action','CategoryManageController@categoryAction')->name('category-action');
                ///================== Sub Category========================//
            Route::get('subcategory','CategoryManageController@subCategory')->name('subcategory');
            Route::get('add-subcategory','CategoryManageController@addSubCategory')->name('add-subcategory');
            Route::get('edit-subcategory/{id}','CategoryManageController@editSubCategory')->name('edit-subcategory');
            Route::post('save-subcategory','CategoryManageController@saveSubCategory')->name('save-subcategory');
            Route::get('delete-subcategory/{id}','CategoryManageController@deleteSubCategory')->name('delete-subcategory');
            Route::post('subcategory-action','CategoryManageController@subCategoryAction')->name('subcategory-action');
            ///================== child Category========================//
            Route::get('childcategory','CategoryManageController@childCategory')->name('childcategory');
            Route::get('add-childcategory','CategoryManageController@addChildCategory')->name('add-childcategory');
            Route::get('edit-childcategory/{id}','CategoryManageController@editChildCategory')->name('edit-childcategory');
            Route::post('save-childcategory','CategoryManageController@savechildCategory')->name('save-childcategory');
            Route::get('delete-childcategory/{id}','CategoryManageController@deleteChildCategory')->name('delete-childcategory');
            Route::post('childcategory-action','CategoryManageController@childCategoryAction')->name('childcategory-action');

            Route::post('get-subcategory','CategoryManageController@getSubcategory')->name('get-subcategory');

            /* Product  Routes */
            Route::get('product','ProductManageController@product')->name('product');
            Route::get('product-list','ProductManageController@productList')->name('product-list');
            Route::get('add-product','ProductManageController@addProduct')->name('add-product');
            Route::get('edit-product/{id}','ProductManageController@editProduct')->name('edit-product');
            Route::post('save-product','ProductManageController@saveProduct')->name('save-product');
            Route::get('delete-product/{id}','ProductManageController@deleteProduct')->name('delete-product');
            Route::post('product-action','ProductManageController@productAction')->name('product-action');
            Route::get('delete-product-image/{id}','ProductManageController@deleteProductImage')->name('delete-product-image');

            ///==================  Banner ========================//
            Route::get('banner','BannerManageController@banner')->name('banner');
            Route::get('add-banner','BannerManageController@addBanner')->name('add-banner');
            Route::get('edit-banner/{id}','BannerManageController@editBanner')->name('edit-banner');
            Route::post('save-banner','BannerManageController@saveBanner')->name('save-banner');
            Route::get('delete-banner/{id}','BannerManageController@deleteBanner')->name('delete-banner');
            Route::post('banner-action','BannerManageController@bannerAction')->name('banner-action');

            ///==================  Below Banner Content ========================//
            Route::get('below-banner','BelowBannerContentController@belowBanner')->name('belowbanner');
            Route::get('add-below-banner','BelowBannerContentController@addBelowBanner')->name('add-below-banner');
            Route::get('edit-below-banner/{id}','BelowBannerContentController@editBelowBanner')->name('edit-below-banner');
            Route::post('save-below-banner','BelowBannerContentController@saveBelowBanner')->name('save-below-banner');
            Route::get('delete-below-banner/{id}','BelowBannerContentController@deleteBelowBanner')->name('delete-below-banner');
            Route::post('banner-below-action','BelowBannerContentController@belowBannerAction')->name('banner-below-action');



            Route::resource('users', 'UserController');

            Route::resource('attr-master', 'AttrMasterController');

            Route::resource('brand', 'BrandController');

            Route::get('/orders', 'OrdersController@index')->name('admin.orders');
            Route::get('/orders-list', 'OrdersController@ordersList')->name('admin.orderslist');
            Route::get('/orders-details/{id?}', 'OrdersController@ordersDetails')->name('admin.ordersDetails');
            Route::post('order-action', 'OrdersController@ordersAction')->name('order-action');

            /* Wishlist Routes */
            Route::get('/wishlist', 'WishlistController@index')->name('admin.wishlist');
            Route::get('/wishlist-list', 'WishlistController@wishList')->name('admin.wishlist.list');

            /* Coupon Routes */
            Route::get('/coupon', 'CouponController@coupon')->name('admin.coupon');
            Route::get('add-coupon','CouponController@addCoupon')->name('add-coupon');
            Route::get('edit-coupon/{id}','CouponController@editCoupon')->name('edit-coupon');
            Route::post('/coupon-save', 'CouponController@couponSave')->name('admin.couponsave');
            Route::get('delete-coupon/{id}','CouponController@deleteCoupon')->name('delete-coupon');

            //Slider
            Route::get('sliders', 'SliderController@sliders')->name('sliders');
            Route::get('add-slider','SliderController@addSlider')->name('add-slider');
            Route::post('save-slider', 'SliderController@saveSlider')->name('save-slider');
            Route::get('delete-slider/{id}','SliderController@deleteSlider')->name('delete-slider');

            //Aboutus
            Route::get('aboutus', 'AboutusController@aboutus')->name('aboutus');
            Route::post('save-aboutus', 'AboutusController@saveAboutus')->name('save-aboutus');

            //App Setting
            Route::get('appsetting', 'AppsettingController@appsetting')->name('app-setting');
            Route::post('save-appsetting', 'AppsettingController@saveAppsetting')->name('save-appsetting');

            // Reviews
            Route::get('reviews', 'ReviewsController@reviews')->name('admin.reviews');
            Route::get('reviews-list', 'ReviewsController@reviewsList')->name('admin.reviews-list');

            // contact us
            Route::get('contactus', 'ContactUsController@contactus')->name('admin.contactus');
            Route::get('contactus-list', 'ContactUsController@contactusList')->name('admin.contactus-list');
            Route::get('contactus-edit/{id?}', 'ContactUsController@contactusEdit')->name('admin.contactus-edit');
            Route::post('contactus-reply/{id?}', 'ContactUsController@contactusReply')->name('admin.contactus-reply');

            // Quick Link

            Route::get('/quicklink', 'QuicklinkController@quicklink')->name('admin.quicklink');
            Route::get('add-quicklink','QuicklinkController@addQuicklink')->name('add-quicklink');
            Route::get('edit-quicklink/{id}','QuicklinkController@editQuicklink')->name('edit-quicklink');
            Route::post('/quicklink-save', 'QuicklinkController@quicklinkSave')->name('admin.quicklinksave');
            Route::get('delete-quicklink/{id}','QuicklinkController@deleteQuicklink')->name('delete-quicklink');

            // faqs

            Route::get('/faqs', 'FaqsController@faqs')->name('admin.faqs');
            Route::get('add-faqs','FaqsController@addFaqs')->name('add-faqs');
            Route::get('edit-faqs/{id}','FaqsController@editFaqs')->name('edit-faqs');
            Route::post('/faqs-save', 'FaqsController@faqsSave')->name('admin.faqssave');
            Route::get('delete-faqs/{id}','FaqsController@deleteFaqs')->name('delete-faqs');

        });
    });
});

Route::get('/run-migrations', function () {
    return Artisan::call('migrate', ["--force" => true ]);
});
Route::get('/run-seed', function () {
    return Artisan::call('db:seed');
});

Auth::routes();

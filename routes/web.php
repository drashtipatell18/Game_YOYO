<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\TopArticlesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MembersSayController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\frontend\LoginController as FrontendLoginController;
use App\Http\Controllers\frontend\AboutUSController;
use App\Http\Controllers\frontend\ContactUsController as FrontendContactUsController;
use App\Http\Controllers\frontend\PrivacyController as FrontendPrivacyController;
use App\Http\Controllers\frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\frontend\ProductController as FrontendProductController;
use App\Http\Controllers\frontend\CartController as FrontendCartController;
use App\Http\Controllers\frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\frontend\GoogleAuthController as FrontGoogleAuthController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\InvoiceController;

use App\Http\Controllers\Yin\YinIndexController;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('index');
});

Route::get('/admin/login', [HomeController::class, 'Login'])->name('login');
Route::post('/login', [HomeController::class, 'LoginStore'])->name('loginstore');

Route::get('/forget-password', [DashboardController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('/forget-password', [DashboardController::class, 'sendResetLinkEmail'])->name('forget.password.email');
Route::get('/reset/{token}', [DashboardController::class, 'reset'])->name('reset');
Route::post('/reset/{token}', [DashboardController::class, 'postReset'])->name('post_reset');
Route::post('/check-current-password', [HomeController::class, 'checkCurrentPassword'])->name('checkCurrentPassword');
Route::get('/change-password', [HomeController::class, 'cPassword'])->name('change-password');
Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');


Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/backendlogout',[UserController::class,'backendlogout'])->name('backendlogout');


// User Routes
Route::get('/users', [UserController::class, 'ViewUsers'])->name('users');
Route::get('/users/create', [UserController::class, 'createUser'])->name('users.create');
Route::post('/users', [UserController::class, 'storeUser'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'updateUser'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroyUser'])->name('users.destroy');


// Category

Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::delete('/category/destroy/{id}',[CategoryController::class,'destroy'])->name('destroy.category');


// Contact Us
Route::get('/contact-us', [ContactUsController::class, 'contactUs'])->name('contactUs');
Route::delete('/contact-us/delete/{id}', [ContactUSController::class, 'deleteContactUs'])->name('contactUs.delete');



// Our Teams
Route::get('/our_teams', [OurTeamController::class, 'ourTeams'])->name('our_teams');
Route::get('/our_teams/create', [OurTeamController::class, 'create'])->name('our_teams.create');
Route::post('/our_teams/store', [OurTeamController::class, 'store'])->name('our_teams.store');
Route::get('/our_teams/edit/{id}', [OurTeamController::class, 'edit'])->name('edit.our_teams');
Route::post('/our_teams/update/{id}', [OurTeamController::class, 'update'])->name('update.our_teams');
Route::delete('/our_teams/destroy/{id}',[OurTeamController::class,'destroy'])->name('destroy.our_teams');


// Privacy
Route::get('/privacy', [PrivacyController::class, 'ViewPrivacy'])->name('privacy');
Route::get('/privacy/create', [PrivacyController::class, 'CreatePrivacy'])->name('privacy.create');
Route::post('/privacy/store', [PrivacyController::class, 'StorePrivacy'])->name('privacy.store');
Route::get('/privacy/edit/{id}', [PrivacyController::class, 'EditPrivacy'])->name('edit.privacy');
Route::post('/privacy/update/{id}', [PrivacyController::class, 'UpdatePrivacy'])->name('update.privacy');
Route::delete('/privacy/destroy/{id}',[PrivacyController::class,'DestroyPrivacy'])->name('destroy.privacy');

// Service
Route::get('/service', [ServiceController::class, 'ViewService'])->name('service');
Route::get('/service/create', [ServiceController::class, 'CreateService'])->name('service.create');
Route::post('/service/store', [ServiceController::class, 'StoreService'])->name('service.store');
Route::get('/service/edit/{id}', [ServiceController::class, 'EditService'])->name('edit.service');
Route::post('/service/update/{id}', [ServiceController::class, 'UpdateService'])->name('update.service');
Route::delete('/service/destroy/{id}',[ServiceController::class,'DestroyService'])->name('destroy.service');

// Products
Route::get('/product',[ProductController::class, 'Product'])->name('product');
Route::get('/product/create',[ProductController::class, 'CreateProduct'])->name('product.create');
Route::post('/product/store',[ProductController::class, 'StoreProduct'])->name('product.store');
Route::get('/product/edit/{id}',[ProductController::class, 'EditProduct'])->name('product.edit');
Route::post('/product/update/{id}',[ProductController::class, 'UpdateProduct'])->name('product.update');
Route::delete('/product/delete/{id}',[ProductController::class, 'DeleteProduct'])->name('product.delete');
Route::post('/product/image/destroy', [ProductController::class, 'destroyImage'])->name('product.image.destroy');
Route::post('/product/toggle-status/{id}', [ProductController::class, 'toggleStatus']);

// Blog
Route::get('/blog', [BlogController::class, 'ViewBlog'])->name('blog');
Route::get('/blog/create', [BlogController::class, 'CreateBlog'])->name('blog.create');
Route::post('/blog/store', [BlogController::class, 'StoreBlog'])->name('blog.store');
Route::get('/blog/edit/{id}', [BlogController::class, 'EditBlog'])->name('edit.blog');
Route::post('/blog/update/{id}', [BlogController::class, 'UpdateBlog'])->name('update.blog');
Route::delete('/blog/destroy/{id}',[BlogController::class,'DestroyBlog'])->name('destroy.blog');
Route::post('/blog/image/destroy', [BlogController::class, 'destroyImage'])->name('blog.image.destroy');
Route::post('/blog/video/destroy', [BlogController::class, 'destroyVideo'])->name('blog.video.destroy');

// Our Teams
Route::get('/articles', [TopArticlesController::class, 'articles'])->name('articles');
Route::get('/articles/create', [TopArticlesController::class, 'create'])->name('articles.create');
Route::post('/articles/store', [TopArticlesController::class, 'store'])->name('articles.store');
Route::get('/articles/edit/{id}', [TopArticlesController::class, 'edit'])->name('edit.articles');
Route::post('/articles/update/{id}', [TopArticlesController::class, 'update'])->name('update.articles');
Route::delete('/articles/destroy/{id}',[TopArticlesController::class,'destroy'])->name('destroy.articles');

// Reviews
Route::get('/reviews', [ReviewController::class, 'reviews'])->name('reviews');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name(name: 'reviews.create');
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/edit/{id}', [ReviewController::class, 'edit'])->name('edit.reviews');
Route::post('/reviews/update/{id}', [ReviewController::class, 'update'])->name('update.reviews');
Route::delete('/reviews/destroy/{id}',[ReviewController::class,'destroy'])->name('destroy.reviews');

// Members Say
Route::get('/members-say', [MembersSayController::class, 'ViewMembersSay'])->name('members-say');
Route::get('/members-say/create', [MembersSayController::class, 'CreateMembersSay'])->name('members-say.create');
Route::post('/members-say/store', [MembersSayController::class, 'StoreMembersSay'])->name('members-say.store');
Route::get('/members-say/edit/{id}', [MembersSayController::class, 'EditMembersSay'])->name('edit.members-say');
Route::post('/members-say/update/{id}', [MembersSayController::class, 'UpdateMembersSay'])->name('update.members-say');
Route::delete('/members-say/destroy/{id}',[MembersSayController::class,'DestroyMembersSay'])->name('destroy.members-say');

// Add to Cart
Route::get('/add-to-cart', [AddToCartController::class, 'AddToCart'])->name('add-to-cart');
Route::get('/add-to-cart/create', [AddToCartController::class, 'CreateAddToCart'])->name('add-to-cart.create');
Route::post('/add-to-cart/store', [AddToCartController::class, 'StoreAddToCart'])->name('add-to-cart.store');
Route::get('/add-to-cart/{id}/edit', [AddToCartController::class, 'EditAddToCart'])->name('add-to-cart.edit');
Route::post('/add-to-cart/update/{id}', [AddToCartController::class, 'UpdateAddToCart'])->name('add-to-cart.update');
Route::delete('/add-to-cart/destroy/{id}', [AddToCartController::class, 'DeleteAddToCart'])->name('add-to-cart.destroy');
Route::post('/add-to-cart/remove/{id}', [AddToCartController::class, 'removeFromCart'])->name('add-to-cart.remove');

Route::Post('/banner_create', [BannerController::class, 'bannerCreate'])->name('banner_create');

});


// Frontend Route

Route::get('auth/google',[FrontGoogleAuthController::class,'redirectToGoogle'])->name('redirect_to_google');
Route::get('auth/google/callback',[FrontGoogleAuthController::class,'handleGoogleCallback'])->name('GoogleAuthCallback');

Route::get('auth/facebook',[FrontGoogleAuthController::class,'redirectToFacebook'])->name('redirect_to_facebook');
Route::get('auth/facebook/callback',[FrontGoogleAuthController::class,'handleFacebookCallback'])->name('FacebookAuthCallback');

Route::get('/frontend-login',[FrontendLoginController::class,'login'])->name('frontend.login');
Route::post('/check-credentials', [FrontendLoginController::class, 'checkCredentials'])->name('checkCredentials');


Route::post('frontlogin', [FrontendLoginController::class, 'frontLogin'])->name('frontlogin');
Route::get('frontregister', [FrontendLoginController::class, 'frontRegister'])->name('frontregister');
Route::post('/check-email-exists', function(Request $request) {
    $exists = \App\Models\User::where('email', $request->email)->exists();
    return response()->json(['exists' => $exists]);
})->name('check.email.exists');

Route::post('/front-register', [FrontendLoginController::class, 'showRegisterForm'])->name('front.register');
Route::post('/frontlogout',[FrontendLoginController::class,'frontlogout'])->name('frontlogout');

Route::get('demo', [FrontendLoginController::class, 'demo'])->name('demo');
Route::get('/frontend-forget',[FrontendLoginController::class,'Forget'])->name('frontendforget');
Route::post('/frontend-forpass',[FrontendLoginController::class,'frontsendResetLinkEmail'])->name('frontresertlink');
Route::get('/front-reset/{token}', [FrontendLoginController::class, 'frontreset'])->name('frontreset');
Route::post('/front-reset/{token}', [FrontendLoginController::class, 'frontpostReset'])->name('frontpost_reset');
Route::get('/index', [FrontendHomeController::class, 'index'])->name('index');
Route::get('/aboutsus', [AboutUSController::class, 'aboutus'])->name(name: 'aboutus');
Route::get('/chatboat', [FrontendHomeController::class, 'FrontendChatboat'])->name('chatboat');

Route::get('/contactus', [FrontendContactUsController::class, 'contactus'])->name('frontendcontactus');
Route::post('/contactus/store', [FrontendContactUsController::class, 'contactusStore'])->name('contactus.store');

Route::get('/frontprivacy', [FrontendPrivacyController::class, 'frontPrivacy'])->name('frontendprivacy');
Route::get('/services', [FrontendServiceController::class, 'service'])->name('frontendservice');
Route::get('/allproducts', [FrontendProductController::class, 'allProducts'])->name('allProducts');
Route::get('/profile/{id?}', [FrontendLoginController::class, 'profile'])->name('profile');
Route::get('/cart', [FrontendCartController::class, 'Cart'])->name('cart');
Route::get('/blogfronted', [FrontendBlogController::class, 'blogfronted'])->name('blogfronted');
Route::post('/profile/update/{id}', [FrontendLoginController::class, 'updateProfile'])->name('profile.update');
Route::get('/productDetails/{id}', [FrontendProductController::class, 'productDetails'])->name('productDetails');
Route::post('/submit-review', [FrontendProductController::class, 'storeReviewProduct'])->name('frontReviewStore')->middleware('auth');
Route::get('/search-products', [FrontendProductController::class, 'search'])->name('search.suggest');
Route::get('/product/{productId}/reviews/load-more', [FrontendProductController::class, 'loadMoreReviews'])
    ->name('product.reviews.loadMore');



Route::get('/invoice/{payment_id}', [InvoiceController::class, 'invoice'])->name('invoice.show');

Route::get('/shipmentPolicy', [PrivacyController::class, 'shipmentPolicy'])->name('shipmentPolicy');
Route::get('/terms_conditions', [PrivacyController::class, 'termsConditions'])->name('terms_conditions');
Route::get('/cancel_refund', [PrivacyController::class, 'cancelRefunds'])->name('cancel_refund');

// Json Data
Route::get('/categoriesJson', [FrontendHomeController::class, 'getCategoriesJson']);
Route::get('/productsJson', [FrontendHomeController::class, 'getProductJson']);
Route::get('/productDetailJson', [FrontendProductController::class, 'getproductDetailJson']);
Route::get('/products/{id}', [ProductController::class, 'getProductDetailJson']);



Route::post('/cart/add', [FrontendCartController::class, 'FrontaddToCart']);
Route::get('/cart/items', [FrontendCartController::class, 'FrontgetCartItems']);
Route::delete('/cart/remove', [FrontendCartController::class, 'FrontremoveFromCart']);
Route::get('/api/cart', [FrontendCartController::class, 'getCartApi']);
Route::delete('/api/cart/{id}', [FrontendCartController::class, 'removeFromCart']);

// Razor Pay Routes
Route::get('/get-payment-details/{productId}', [RazorpayController::class, 'getPaymentDetails'])->middleware('auth');
Route::post('/payment/success', [RazorpayController::class, 'paymentSuccess'])->middleware('auth');

Route::get('/get-payment-details-cart/{cartId}', [RazorpayController::class, 'getCartPaymentDetails'])->middleware('auth');
Route::post('/cart/success', [RazorpayController::class, 'getCartpaymentSuccess'])->middleware('auth');



// ai route

Route::get('yin/index', [YinIndexController::class, 'yinIndex'])->name('yin.index');
Route::get('yin/learningCoatch', [YinIndexController::class, 'yinLearningCoatch'])->name('yin.learningCoatch');
Route::get('yin/savedInfo', [YinIndexController::class, 'yinSavedInfo'])->name('yin.savedInfo');
Route::get('yin/public_link', [YinIndexController::class, 'yinPublicLink'])->name('yin.public_link');
Route::get('yin/explore_gem', [YinIndexController::class, 'yinExploreGem'])->name('yin.explore_gem');
Route::get('yin/new_gem', [YinIndexController::class, 'yinNewGem'])->name('yin.new_gem');
Route::get('yin/search', [YinIndexController::class, 'yinSearch'])->name('yin.search');
Route::get('yin/careerguide', [YinIndexController::class, 'CareerGuide'])->name('yin.careerguide');
Route::get('yin/upgrade', [YinIndexController::class, 'yinUpgrade'])->name('yin.upgrade');
Route::get('yin/chesschamp', [YinIndexController::class, 'ChessChamp'])->name('yin.chesschamp');
Route::get('yin/brainstormer', [YinIndexController::class, 'Brainstormer'])->name('yin.brainstormer');
Route::get('yin/login', [YinIndexController::class, 'yinLogin'])->name('yin.login');
Route::get('yin/signup',[ YinIndexController::class, 'yinSignUp'])->name('yin.signup'); // Assuming signup redirects to login view
Route::get('yin/codingpartner', [YinIndexController::class, 'CodingPartner'])->name('yin.codingpartner');
Route::get('yin/writingeditor', [YinIndexController::class, 'writingEditor'])->name('yin.writingEditor');

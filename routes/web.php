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

use App\Http\Controllers\frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\frontend\LoginController as FrontendLoginController;
use App\Http\Controllers\frontend\AboutUSController;
use App\Http\Controllers\frontend\ContactUsController as FrontendContactUsController;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [HomeController::class, 'Login'])->name('login');
Route::post('/login', [HomeController::class, 'LoginStore'])->name('loginstore');
Route::get('/logout',[HomeController::class,'logout'])->name('logout');
Route::get('/forget-password', [DashboardController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('/forget-password', [DashboardController::class, 'sendResetLinkEmail'])->name('forget.password.email');
Route::get('/reset/{token}', [DashboardController::class, 'reset'])->name('reset');
Route::post('/reset/{token}', [DashboardController::class, 'postReset'])->name('post_reset');
Route::post('/check-current-password', [HomeController::class, 'checkCurrentPassword'])->name('checkCurrentPassword');
Route::get('/change-password', [HomeController::class, 'cPassword'])->name('change-password');
Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');


Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


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

// Members Say
Route::get('/members-say', [MembersSayController::class, 'ViewMembersSay'])->name('members-say');
Route::get('/members-say/create', [MembersSayController::class, 'CreateMembersSay'])->name('members-say.create');
Route::post('/members-say/store', [MembersSayController::class, 'StoreMembersSay'])->name('members-say.store');
Route::get('/members-say/edit/{id}', [MembersSayController::class, 'EditMembersSay'])->name('edit.members-say');
Route::post('/members-say/update/{id}', [MembersSayController::class, 'UpdateMembersSay'])->name('update.members-say');
Route::delete('/members-say/destroy/{id}',[MembersSayController::class,'DestroyMembersSay'])->name('destroy.members-say');


});


// Frontend Route

Route::get('/frontend-login',[FrontendLoginController::class,'login'])->name('frontend.login');
Route::get('/index', [FrontendHomeController::class, 'index'])->name('index');
Route::get('/aboutsus', [AboutUSController::class, 'aboutus'])->name(name: 'aboutus');
Route::get('/contactus', [FrontendContactUsController::class, 'contactus'])->name('frontendcontactus');

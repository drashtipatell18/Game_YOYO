<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\OurTeamController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

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

});

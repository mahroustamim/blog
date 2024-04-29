<?php

// use App\Http\Controllers\dashboard\SettingController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\IndexController;
use App\Http\Controllers\dashboard\PostController;
use App\Http\Controllers\dashboard\SettingController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\WriterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

//=========================== admin * writer ==============================

Route::prefix('dashboard/')->name('dashboard.')->middleware(['auth', 'has.dashboard'])->group(function() {

    Route::get('home', [IndexController::class, 'index'])->name('home');
    
    Route::get('profile/{id}', [UserController::class, 'edit'])->name('profile.edit');
    
    Route::get('settings/index', [SettingController::class, 'index'])->name('settings.index');

    Route::put('settings/update/{id}', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('users', UserController::class);

    Route::post('users/delete', [UserController::class, 'delete'])->name('users.delete');

    Route::get('writer', [WriterController::class, 'index'])->name('writer');

    Route::resource('categories', CategoryController::class);

    Route::post('categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

    Route::resource('posts', PostController::class);

    Route::post('posts/delete', [PostController::class, 'delete'])->name('posts.delete');

    
});

//=========================== ========== ==============================

//============================== User =================================

Route::prefix('website/')->name('website.')->group(function() {

    Route::get('/home',[App\Http\Controllers\website\IndexController::class, 'index'])->name('home');

    Route::get('/about',[App\Http\Controllers\website\IndexController::class, 'about'])->name('about');
    
    Route::get('/search',[App\Http\Controllers\website\IndexController::class, 'search'])->name('search');

    Route::middleware('auth')->group(function () {

        Route::get('/home/{user}',[App\Http\Controllers\website\SettingController::class, 'index'])->name('setting');
        
        Route::post('/setting/delete/{user}',[App\Http\Controllers\website\SettingController::class, 'delete'])->name('setting.delete');

        Route::put('/setting/update/{id}',[App\Http\Controllers\website\SettingController::class, 'update'])->name('setting.update');

    });
    
    Route::get('/post/{post}',[App\Http\Controllers\website\PostController::class, 'index'])->name('post');
    
    Route::post('/comment/{id}',[App\Http\Controllers\website\CommentController::class, 'store'])->name('comment');
    
    Route::post('/comment/delete/{comment}',[App\Http\Controllers\website\CommentController::class, 'delete'])->name('comment.delete');

    Route::get('/category/{category}',[App\Http\Controllers\website\CategoryController::class, 'index'])->name('category');

});

//=========================== ========== ==============================
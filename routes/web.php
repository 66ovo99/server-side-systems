<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 欢迎页
Route::get('/welcome', function () {
    return view('welcome');
});

// 首页
Route::get('/index', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

// 个人中心
Route::get('/personal', [App\Http\Controllers\UserController::class, 'showPersonalPage'])->name('personal');

// 用户名相关
Route::get('/user/username', [\App\Http\Controllers\UserController::class, 'editUsername'])->name('user.username.edit');
Route::get('/user/edit', [App\Http\Controllers\UserController::class, 'editUserName'])->name('user.name.edit');
Route::put('/user/update', [App\Http\Controllers\UserController::class, 'updateUserName'])->name('user.name.update');
Route::put('/user', [\App\Http\Controllers\UserController::class, 'infoUpdate'])->name('user.info.update');

// 头像相关
Route::get('/user/avatar', [\App\Http\Controllers\UserController::class, 'avatarPage'])->name('user.avatar');
Route::put('/user/avatar', [\App\Http\Controllers\UserController::class, 'avatarUpdate'])->name('user.avatar.update');

// 博客相关
Route::resource('blogs', \App\Http\Controllers\BlogController::class);
Route::post('/blogs/{id}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('blogs.comments.store');
Route::get('/blogs/{id}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');


// 用户退出
Route::post('/logout', function () { Auth::logout(); return redirect('/index');})->name('logout');

// 登录与注册
Route::get('/login', function () {return view('index.login');})->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::get('/register', function () {return view('index.register');})->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);

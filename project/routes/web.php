<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('admin.dashboard'));

route::middleware(['auth'])->group(function (){
    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();



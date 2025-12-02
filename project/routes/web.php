<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn() => redirect()->route('articles.index'));

// Protect articles routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticleController::class)->except(['show']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
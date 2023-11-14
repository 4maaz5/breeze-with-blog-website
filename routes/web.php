<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikeController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/logout',[ShowController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [ShowController::class, 'users'])->name('users');
    Route::get('/about', [ShowController::class, 'index'])->name('about');
    Route::get('/sports', [ShowController::class, 'sport'])->name('sports');
    Route::get('/travel', [ShowController::class, 'travel'])->name('travel');
    Route::get('/politics', [ShowController::class, 'politics'])->name('politics');
    Route::get('/trend', [ShowController::class, 'trend'])->name('trend');
    Route::get('/like/{id?}', [ShowController::class, 'like'])->name('like');
    Route::get('/view/{id}', [ShowController::class, 'view'])->name('view');
    Route::post('/about', [PostController::class, 'insert'])->name('insert');
    Route::get('/dashboard', [ShowController::class, 'display'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->middleware(['can:isAdmin'])->name('edit');
    Route::put('/edit/{id}', [PostController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PostController::class, 'delete'])->middleware(['can:isAdmin'])->name('delete');
    Route::post('/search', [ShowController::class, 'search'])->name('search');
    Route::post('/comment/{id}', [CommentsController::class, 'comment'])->name('comment');
    Route::get('/comments/delete/{id}', [CommentsController::class, 'display'])->name('viewcomment');
    Route::get('/comments/{id}', [CommentsController::class, 'trash'])->name('trash');

    // Route::get('likess',[LikeController::class, 'likehandle']);

    Route::get('/contact', [ShowController::class, 'contact'])->name('contact');
    Route::post('/contact', [ShowController::class, 'contactSave'])->name('contactSave');
    Route::post('/process', [ShowController::class, 'processButton'])->name('process');
});

Route::get('show', [ShowController::class, 'Show']);
Route::get('check', [ShowController::class, 'check']);
Route::get('/report', function () {
    return view('report');
})->middleware('auth');

require __DIR__ . '/auth.php';

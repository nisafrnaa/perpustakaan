<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('landingpage');

Route::get('/bookmarks', [BookController::class, 'bookmarks'])->name('bookmarks');

// Admin User Routes
Route::resource('admin/users', UserController::class)->middleware('admin');

// Book Routes
Route::middleware('auth')->group(function () {
    Route::post('/books/{book}/bookmark', [BookController::class, 'bookmark'])->name('books.bookmark');
    Route::post('/books/{book}/unbookmark', [BookController::class, 'unbookmark'])->name('books.unbookmark');
    Route::post('/books/{book}/borrow-request', [BookController::class, 'borrowRequest'])->name('books.borrowRequest');
    Route::get('books/publish', [App\Http\Controllers\User\BookController::class, 'index'])->name('publish.index');
    Route::get('books/publish/create', [App\Http\Controllers\User\BookController::class, 'create'])->name('publish.create');
    Route::post('books/publish', [App\Http\Controllers\User\BookController::class, 'store'])->name('publish.store');
    Route::get('books/publish/{book}/edit', [App\Http\Controllers\User\BookController::class, 'edit'])->name('publish.edit');
    Route::put('books/publish/{book}', [App\Http\Controllers\User\BookController::class, 'update'])->name('publish.update');
    Route::post('books/publish/{book}/approve', [BookController::class, 'approve'])->name('publish.approve');
    Route::post('books/publish/{book}/disapprove', [BookController::class, 'disapprove'])->name('publish.disapprove');
    Route::delete('books/publish', [BookController::class, 'destroy'])->name('publish.destroy');
});

Route::middleware('admin')->group(function () {
    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
    Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('books/request', [BookController::class, 'borrowApproval'])->name('books.borrowApproval');
    Route::post('/books/request/{request}/approve', [BookController::class, 'borrowApprove'])->name('books.borrowApprove');
});

// Public Book Routes
Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');

// Category Routes
Route::middleware('admin')->group(function () {
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::get('categories/{category}/books', [CategoryController::class, 'show'])->name('categories.show');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

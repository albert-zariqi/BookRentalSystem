<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BorrowController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/search', [BookController::class, 'search'])->name('search');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create')->middleware('auth');
Route::post('/books', [BookController::class, 'store'])->name('books.store')->middleware('auth');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update')->middleware('auth');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy')->middleware('auth');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit')->middleware('auth');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create')->middleware('auth');
Route::post('/genres', [GenreController::class, 'store'])->name('genres.store')->middleware('auth');
Route::put('/genres/{genre}', [GenreController::class, 'update'])->name('genres.update')->middleware('auth');
Route::delete('/genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy')->middleware('auth');
Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit')->middleware('auth');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');
// Route::view('/books/{book}/detail', [BookController::class, 'detail'])->name('books.detail');
// Route::resource('books', BookController::class)->middleware('auth');
// Route::view('/genres/{genre}/detail', [GenreController::class, 'detail'])->name('genres.detail');
// Route::resource('genres', GenreController::class)->middleware('auth');
Route::resource('borrows', BorrowController::class)->middleware('auth');

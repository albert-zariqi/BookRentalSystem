<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
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
Route::get('/search', [BookController::class, 'search'])->name('search');
// Route::view('/books/{book}/detail', [BookController::class, 'detail'])->name('books.detail');
// Route::view('/books/create', [BookController::class, 'create'])->name('books.create');
Route::resource('books', BookController::class)/*->middleware('auth')*/;
// Route::view('/genres/{genre}/detail', [GenreController::class, 'detail'])->name('genres.detail');
Route::resource('genres', GenreController::class)/*->middleware('auth')*/;

<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
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

// home route
Route::get('/', [BaseController::class, 'index'])->name('home');
// top author route
Route::get('/top-author', [BaseController::class, 'topAuthor'])->name('top-author');
// add rating route
Route::get('/rating', [BaseController::class, 'addRating'])->name('rating');
Route::post('/rating/add', [RatingController::class, 'store'])->name('rating.store');

// select author by id route
Route::get('/get-books-by-author/{authorId}',[RatingController::class, 'getBooksByAuthor']);


// search route
Route::post('/search', [SearchController::class, 'index'])->name('search');
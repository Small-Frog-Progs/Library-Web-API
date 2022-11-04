<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/login', [UserController::class, 'auth']);

Route::middleware('check.bearer')->group(function() {

    Route::middleware('check.admin')->group(function() {
        Route::post('/register', [UserController::class, 'store'])->name('user.store');
        Route::post('/reader/index', [UserController::class, 'index'])->name('user.index');
        Route::post('/reader/{id}', [UserController::class, 'show'])->name('user.show');
        //get
        Route::patch('/reader/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/reader/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::post('/author/index',[AuthorController::class, 'index'])->name('author.index');
        Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
        Route::post('/author/{id}', [AuthorController::class, 'show'])->name('author.show');
        Route::patch('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
        Route::delete('/author/delete/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');

        Route::get('/genre/index', [GenreController::class, 'index'])->name('genre.index');
        Route::get('/genre/{id}', [GenreController::class, 'show'])->name('genre.show');

        Route::post('/journal/index', [JournalController::class, 'index'])->name('journal.index');
        Route::post('/journal/{id}', [JournalController::class, 'show'])->name('journal.show');
        Route::patch('/journal/update/{id}', [JournalController::class, 'update'])->name('journal.update');
        Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');

        Route::post('/book/index', [BookController::class, 'index'])->name('book.index');
//        Route::post('/book', [BookController::class, 'store'])->name('book.store');
        Route::post('/book/{id}', [BookController::class, 'show'])->name('book.show');
    });

});


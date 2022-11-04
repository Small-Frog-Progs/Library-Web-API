<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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
        Route::get('/reader/index', [UserController::class, 'index'])->name('user.index');

        Route::get('/author/index',[AuthorController::class, 'index'])->name('author.index');
        Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
        Route::patch('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
        Route::delete('/author/delete/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');

        Route::get('/book/index', [BookController::class, 'index'])->name('book.index');
//        Route::post('/book', [BookController::class, 'store'])->name('book.store');
        Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
    });

});


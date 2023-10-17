<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

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

Route::group([
    'middleware' => 'guest'
], function () {
    Route::get('/', function () {
        return view('login');
    })->name('home');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group([
    'middleware' => 'user'
], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group([
        'prefix' => 'authors',
        'as' => 'authors'
    ], function () {
        Route::get('/', [AuthorController::class, 'list'])->name('.list');
        Route::get('/{author}', [AuthorController::class, 'single'])->name('.single');
        Route::delete('/{author}', [AuthorController::class, 'delete'])->name('.delete');
    });

    Route::group([
        'prefix' => 'books',
        'as' => 'books'
    ], function () {
        Route::get('/{book?}', [BookController::class, 'single'])->name('.single');
        Route::post('/', [BookController::class, 'create'])->name('.create');
        Route::delete('/{book}', [BookController::class, 'delete'])->name('.delete');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;





Route::get('/', [PublicController::class, 'home'])
    ->name('home');


Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');


Route::middleware('auth')->group(function () {

    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create');
});


Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

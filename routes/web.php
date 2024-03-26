<?php

use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'));
Route::post('/', [FeedController::class, "processFeed"]);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RankController;

Route::get('/rankings', [RankController::class, 'index'])
    ->name('rankings.index');
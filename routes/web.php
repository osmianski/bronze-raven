<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SlugController;
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

Route::post('/pages', [PageController::class, 'update']);

Route::get('/', [SlugController::class, 'home']);
Route::get('{slug:slug}.html', [SlugController::class, 'show'])
    ->where('slug', '([A-Za-z0-9\-\/]+)');

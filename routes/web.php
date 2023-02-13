<?php

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

Route::get('/', [SlugController::class, 'home']);
Route::get('{slug:slug}', [SlugController::class, 'show'])
    ->where('slug', '([A-Za-z0-9\-\/]+)');

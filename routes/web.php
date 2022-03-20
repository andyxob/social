<?php

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

Route::get('/', [\App\Http\Controllers\MainController::class , 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/search', [\App\Http\Controllers\SearchController::class , 'getResults'])->name('search.results');
Route::get('/user/{username}', [\App\Http\Controllers\ProfileController::class, 'getProfile'])->name('profile.index');
Route::get('profile/edit', [\App\Http\Controllers\ProfileController::class, 'getEdit'])->middleware('auth')->name('profile.edit');
Route::post('profile/edit', [\App\Http\Controllers\ProfileController::class, 'postEdit'])->middleware('auth')->name('profile.edit');
require __DIR__.'/auth.php';

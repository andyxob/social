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


Route::group(['middleware'=>'auth',
    'prefix'=>'friends'],function (){
    Route::get('/', [\App\Http\Controllers\FriendController::class, 'getIndex'])->name('friends.index');
    Route::get('/add/{name}', [\App\Http\Controllers\FriendController::class, 'getAdd'])->name('friends.add');
    Route::get('/accept/{name}', [\App\Http\Controllers\FriendController::class, 'getAccept'])->name('friends.accept');
    Route::get('/delete/{name}', [\App\Http\Controllers\FriendController::class, 'postDelete'])->name('friends.delete');

});

Route::get('/admin', [\App\Http\Controllers\MainController::class , 'admin'])->middleware('is_admin')->name('admin.index');


Route::post('/status', [\App\Http\Controllers\StatusController::class, 'postStatus'])->middleware('auth')->name('status.post');
Route::post('/status/{StatusId}/reply', [\App\Http\Controllers\StatusController::class, 'postReply'])->middleware('auth')->name('status.reply');

Route::get('/status/{StatusId}/like', [\App\Http\Controllers\StatusController::class , 'getLike'])->middleware('auth')->name('status.like');

require __DIR__.'/auth.php';

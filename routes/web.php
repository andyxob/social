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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'getResults'])->name('search.results');


Route::group(['middleware'=>'auth'], function (){

    Route::get('/user/{username}', [\App\Http\Controllers\ProfileController::class, 'getProfile'])->name('profile.index');
    Route::get('profile/edit', [\App\Http\Controllers\ProfileController::class, 'getEdit'])->name('profile.edit');
    Route::post('profile/edit', [\App\Http\Controllers\ProfileController::class, 'postEdit'])->name('profile.edit');

    Route::group( ['prefix' => 'friends'], function () {
        Route::get('/', [\App\Http\Controllers\FriendController::class, 'getIndex'])->name('friends.index');
        Route::get('/add/{name}', [\App\Http\Controllers\FriendController::class, 'getAdd'])->name('friends.add');
        Route::get('/accept/{name}', [\App\Http\Controllers\FriendController::class, 'getAccept'])->name('friends.accept');
        Route::get('/delete/{name}', [\App\Http\Controllers\FriendController::class, 'postDelete'])->name('friends.delete');


        Route::group(['prefix' => 'status'], function () {
            Route::post('/', [\App\Http\Controllers\StatusController::class, 'postStatus'])->middleware('auth')->name('status.post');
            Route::post('/{StatusId}/reply', [\App\Http\Controllers\StatusController::class, 'postReply'])->middleware('auth')->name('status.reply');
            Route::get('/{StatusId}/like', [\App\Http\Controllers\StatusController::class, 'getLike'])->middleware('auth')->name('status.like');
        });
    });
});


Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
    Route::get('/', [\App\Http\Controllers\MainController::class, 'admin'])->name('admin.index');
    Route::resource('statuses', \App\Http\Controllers\Admin\StatusController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

});



require __DIR__ . '/auth.php';

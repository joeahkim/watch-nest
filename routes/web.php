<?php

use Illuminate\Support\Facades\Route;
use App\Anime\AnimeController;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


Route::get('shows/show-details/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'animeDetails'])->name('anime.details');

Route::post('shows/insert-comments/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'insertComments'])->name('anime.insert.comments');

Route::post('shows/follow/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'follow'])->name('anime.follow');


Route::get('shows/anime-watching/{show_id}/{episode_id}', [App\Http\Controllers\Anime\AnimeController::class, 'animeWatching'])->name('anime.watching');

Route::get('shows/category/{category_name}', [App\Http\Controllers\Anime\AnimeController::class, 'category'])->name('anime.category');

Route::get('users/followed-shows', [App\Http\Controllers\Users\UsersController::class, 'followedShows'])->name('user.followed.shows');

Route::any('shows/search', [App\Http\Controllers\Anime\AnimeController::class, 'searchShows'])->name('anime.search.shows')->middleware('auth:web');


Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login');

Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');


Route::group(['prefix' => 'admin'], function(){
    Route::get('/index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

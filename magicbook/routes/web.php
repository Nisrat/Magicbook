<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile;
use App\Http\Controllers\Chapter;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('index');
});
//Route::get('/profile','Profile@index');
Route::resource('/fetchData', Profile::class, ['except' => ['create', 'edit']]);
Route::resource('/fetchChapter', Chapter::class, ['except' => ['create', 'edit']]);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PagesController;

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
Auth::routes();

Route::group(['middleware' => ['web']],function(){

    Route::get('blog/{slug}', [BlogController::class, 'getSingle'])->where('slug','[\w\d\-\_]+')->name('blog.single');
   
  Route::get('/blog',[BlogController::class, 'getIndex'])->name('blog.index');
 
  
Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contact',[PagesController::class,'getContact']);
Route::post('/contact',[PagesController::class,'postContact']);
Route::get('/',[BlogController::class, 'getwel'])->name('pages.welcome');

Route::resource('/posts',PostController::class);
});
<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     // return env('CREATOR_NAME'); //sends an env
//     return view('home'); //sends an view file.
//     // return 'Welcome to the users page'; //sends string
//     // return ['Welcome', 'to', 'the', 'users page']; //sends array(json)
//     // return response()->json([
//     //     'name'=>'Dary',
//     //     'course'=>'Laravel'
//     // ]);
    
// });

Route::get('/users',function(){
    return 'Welcome to the users page';
});

Route::get('/home',[PagesController::class,'home'])->name('home');
Route::get('/apps',[PagesController::class,'index'])->name('apps');
Route::get('/apps/about',[PagesController::class,'about']);
//Pattern is an integer
// Route::get('/apps/{id}',[AppsController::class,'show'])-> where('id','[0-9]+');
Route::get('/apps/{name}/{id}',[PagesController::class,'show'])-> where([
    'name'=>'[a-zA-Z]+',
    'id' => '[0-9]+'

]);
// Route::get('/apps','App\Http\Controllers\AppsController@index',function(){});
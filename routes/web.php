<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppsController;
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

Route::get('/apps',[AppsController::class,'index']);
Route::get('/apps/about',[AppsController::class,'about']);

// Route::get('/apps','App\Http\Controllers\AppsController@index',function(){});
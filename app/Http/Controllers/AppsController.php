<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AppsController extends Controller
{
    public function index(){
        //Non fluent table - only nice if beginners
        // DB::select(['table'=> 'posts', 'where'=>['id'=>1]])
        //Fluent Table - Allows Chaining
        // DB:table('posts') -> where ('id',1)->get()
        $id=7;
        $apps= DB::table('apps')
        ->where('id','=',10)->delete();
        dd($apps);
        //   return view('apps.index',[$apps]);
      }
      public function show($id){
        return view('apps.index',['id'=>$id]);
    }
}

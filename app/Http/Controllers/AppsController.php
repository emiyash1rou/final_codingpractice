<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppsController extends Controller
{
  public function index(){
      $title="Mer";
      $description="Developers yarn";
      $data=[
          'product1' =>"iphone",
          'samsong' =>'heashee'
      ];
    //   return view('apps.index',compact('title','description'));

    // return view('apps.index')->with('data',$data);
    return view('apps.index',[
        'data'=>$data
        
    ]);
  }
  public function about(){
    return 'Hello';
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function index(){
    
    //   $data=[
    //       'product1' =>"iphone",
    //       'samsong' =>'heashee'
    //   ];
        // print_r(route('apps'));
      return view('pages.index');

    // return view('apps.index')->with('data',$data);
    // return view('apps.index',[
    //     'data'=>$data
        
    // ]);
  }
  public function home(){
    return view('pages.home',['apps'=>"hello"]);
}
  public function about(){
    return view('pages.index',['apps'=>"hello"]);
}
public function show($id){
    $data=[
        'iphone' =>"iphone",
        'samsung' =>'heashee'
    ];
    return view('pages.index',['apps'=> $data[$id] ?? 'App ' . $id . 'does not exist' ]);
}
}

## TIPS
### LARAVEL DIRECTORY 
1. Getting env files to web.php = ``` return env('DB_DATABASE'); ```
2. There are two files. .env and .envexample in laravel so that if changes are inflicted in .env, there is a backup. 
3. Composer install dependencies. Specify project dependencies. In composer.json.
- require is most important part that installdependencies. Dependencies are accessed in vendor libraries. 
- require.dev are packages that are not necessary in project work. T
- autoload. if you need to autoload something in web immediately.
Composer.lock delete. ``` rm -rf composer.lock ``` to generate .lock. Do ```composer i ``` or just do ``` composer update ``` to update the lock file and update dependencies.
4. <a>packagist.org</a> search package and use composer to manage your packages.
5. ``` composer show --tree ``` all projects in laravel. Laravel uses a lot of laravel 3rd Party API. 
6. ``` composer dump-autoload ``` generates autoload files. Files that are required in autoload.
### CODING TIPS
1. Requests: 
- Simple get Request
```
Route::get('/', function () {
    return env('CREATOR_NAME'); //sends an env
    return view('welcome'); //sends an view file.
    return 'Welcome to the users page'; //sends string
    return ['Welcome', 'to', 'the', 'users page']; //sends array(json)
   return response()->json([
        'name'=>'Dary',
        'course'=>'Laravel'
    ]);
    
});
// localhost:8000/ 
Route::get('/users',function(){
    return 'Welcome to the users page';
});
// localhost:8000/users
```
2. Sending an array on request will automatically convert it to a JSON response.
3. redirect page using ``` return redirect('/')' ```
4. Ask for help for commmands : ``` php artisan --list ```
5. Make a controller class. ``` php artisan make:controller [name] -help``` to ask for help.
- in web.php. Preferred call for route.
``` 
use App\Http\Controllers\AppsController; 
Route::get('/apps',[AppsController::class,'index']);
```
- return view('products.index'); //the dot(.) is basically a forward slash.
[Alternative] 
- For Laravel 8
```
Route::get('/apps','App\Http\Controllers\AppsController@index',function(){

});
```
-  Before Laravel 8
```
Route::get('/apps','AppsController@index',function(){

});
```
6. Shortcut to use templates. When typing and function gets hovered. Press tab. Like foreach + tab
7. Passing in data. 
[First] - Using Compact
```
public function index(){
      $title="Mer";
      $description="Developers yarn";
      return view('apps.index',compact('title','description'));
  }

```
[Second] - Using with method
```

public function index(){
      $title="Mer";
      $description="Developers yarn";
    return view('apps.index')->with('title',$title);
  }

```
[Third] - Using with method(Not recommended)
```
   return view('apps.index',[
        'data'=>$data
        
    ]);
```
- with method only passes a single file. The compact method passes multiple. An array is conidered a single file. NOTE: with('title',$title) must be the same.

```
// in AppsController
 public function index(){
      $title="Mer";
      $description="Developers yarn";
      $data=[
          'product1' =>"iphone",
          'samsong' =>'hehee'
      ];
    //   return view('apps.index',compact('title','description'));

    return view('apps.index')->with('data',$data);
  }
// in website blade.
           @foreach($data as $item)
                                        <p>
                                            {{ $item }}
                                        </p>
                                        @endforeach
```

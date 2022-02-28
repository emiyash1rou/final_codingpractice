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
8. Operands. ```   return view('apps.index',['apps'=> $data[$id] ?? 'App ' . $id . 'does not exist' ]); ``` if $id exists then return with view $id else(??) return String "app $id does not exist " 
9. Limit the route links you have. In web.php ``` Route::get('/apps/{id}',[AppsController::class,'show'])-> where('id','[0-9]+'); ```. where function looks at your parameters and second parameter is its regular expression where you need to allow or disallow. Another example ``` Route::get('/apps/{name}',[AppsController::class,'show'])-> where('name','[a-zA-Z]+'); ```. 
- Multiple constraints. 
``` 
Route::get('/apps/{name}/{id}',[AppsController::class,'show'])-> where([
    'name'=>'[a-zA-Z]+',
    'id' => '[0-9]+'

]); 
``` 
[NOTE] - name/id needs to be in order. 121312/name wont work.
10. Naming the routes ``` Route::get('/apps',[AppsController::class,'index'])->name('apps'); ``` or just ``` {{ route('products') }} ``` -> Remember that you need to name route in order to do the second code. ``` name('apps'); ```

11. Layouts. 
- Includes ```  @include('layouts.footer') ``` extends is ```  @extends('layouts.footer') ``` extends is preferrable.
12. Setting navbar as active. ```       <a class="nav-link {{ request()->is('apps') ? 'active' : '' }}" href="{{route('apps')}}"> ``` put an active class when request is / else don't put it.
- If you want the navbar active while it traverses its subpage do this. ``` <a class="nav-link {{ request()->is('apps/*') ? 'active' : '' }}" href="{{route('apps')}}"> ``` add /*
13. Public Directory. 
- Put all your folders inside the Public Directory.
- when getting it, use laravel URL for src. ``` {{ URL('images/icon-box/jpg')}} ```
[ALTERNATIVE]
- ```php artisan storage:link``` to create storage directory. This makes it have security on the storage and ideal for large projects, It also allows method logic in images.  If simple, then just do the former.
- URL() and asset() are the same methods.
14. Structure
```
@[structure]
<h1></h1>
{{ $hello }}
@[endstructure]
```
- Default Directive executes whenever no expression is = in switch.
```
@switch($name)
@case('Dary')
<h2>Dary</h2>
@break
@case('Mer')
<h2>Dary</h2>
@break
@default
<h2> No match found</h2>
@endswitch
```
- Loops
```
@for($initialization=0; condition; loopcounter)
@endfor

//foreach needs array
@foreach($collection as $item )

@endforeach

//compile check for empty input
@forelse($collection as $item)
//if empty
@empty
<h2> Go here </h2>
@endforelse

@while($condition)
{{ $condition++ }}
@endwhile

```
# STOPPED AT 2:49 hr


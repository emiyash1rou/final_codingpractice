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
15. webpack.mix.js 
``` 
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
```
- We can add scss by replacing to this.
```
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css', [
        //
    ]);

```
- ```npm install```
- ```npm run dev ```to run our webpack.
- Compile by running ```npm run dev``` again.
- run ```npm run watch ``` in one terminal and run your server on the other. It should auto update your css.
16. Frontend Presets to Pull In [ Dont do when working on a project ]
- cd on your project root
- ```php artisan present tailwind``` last parameter can be bootstap, tailwindcss. Please check the github for tailwind 
- ```php artisan ui tailwindcss``` Generates preset frameworks. Laravel is awesome.
### DATABASE
#### Eloquent
- is an object relational matter. Using OOP-like.
1. Where to access database. Go to ``` config/database.php ```. Bunch of database are written there. You can have more than one connection. Up to 5 database connections.
2.  ```.env ``` to connect.
3. Create Controller. ```php artisan make:controller PostsController ```
4. Create a model by ```php artisan make:model Post ``` - needs to be singular.
- Access App/http/Models to access your Model.
5.  Add Migrations.
- 2 Steps
- [1] *not preferred*
- ``` php artisan make:migration create_posts_table```
- [2] *Preferred*
- ``` php artisan make:model Post -m ``` to auto create the first step.
6. Access migrations by going to ```database/migrations```
- Laravel has default migration for user registrations etcc.
7. Add table rows using migrations. 
- Up method in your migrations migrates every code it has in it. You can rollback to the previous version using down method, or undo it.
- Format.
``` 
 Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        }); 
```
- to add table use this
```
  Schema::create('apps', function (Blueprint $table) {
            $table->increments('id'); //increments name id
            $table->string('title');   // $table->datatype(name)
            $table->mediumText('body');
            $table->timestamps();
            // $table->id();
            // $table->timestamps();
        });
```
- ```php artisan migrate ``` to migrate, save changes.
- ``` php artisan migrate:install ``` keep track on which migrations you have and have not run.  Pretty much the same as the migrate command.
- ``` php artisan migrate:reset ``` call a down method roll backs(undo). DILI madelete ang naa sa imong migrations pero madelete tung sa database na migrations table.
- ``` php artisan migrate:refresh ``` call a down method roll backs(undo). then runs the migration available. 
-``` php artisan migrate:fresh ``` is same thing as refresh but doens't call down method. just delete tables and runs the up migrations again.
-``` php artisan migrate:fresh ``` rollback only.
-``` php artisan migrate:status ``` check table listing of every migrations whether or not it has been run yet on the environment.
8. Factory Model - Creates Dummy data at ease.
- ``` php artisan make:factory AppFactory ``` to create a Factory.
- ``` php artisan make:factory AppFactory  --model=App``` determine your model. 
- In your AppFactory.php 
```
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\App>
 */
class AppFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'body' => $this->faker->paragraph,
            'created_at' => now(),

        ];
    }
}

```
- strictly, the table names must be the same. $this->faker(calls generator)-> datatype
- run by using ``` php artisan tinker ```
- then generate by going inputting command ``` \App\Models\App::factory()->create(); ```
- you can specify rows to add by using  ``` \App\Models\App::factory()->count(3)->create(); ```
9. Query Builder
- Two ways to write a query.
```
        //Non fluent table - only nice if beginners
        // DB::select(['table'=> 'posts', 'where'=>['id'=>1]])
        //Fluent Table - Allows Chaining - Preferable
        // DB:table('posts') -> where ('id',1)->get()
```
- Selecting and printing a query.
```
    public function index(){
       
        $apps= DB::select('select * from apps');
        dd($apps);
     
      }
```
- To avoid sql attacks use ```   $apps= DB::select('select * from apps WHERE id=?',[7]); ``` or  ```   $apps= DB::select('select * from apps WHERE id=:id',['id'=>7]); ```
- CREATING YOUR OWN QUERY
- This is called chaining as it chains different aspects of table. This is interpreted as 'select * from apps where id=7.' 
```     
$id=7;
$apps= DB::table('apps')    
->where('id',$id)->get(); 
```
- Getting just the body by ```     $apps= DB::table('apps') ->select('body')->get(); ```
- where(column,comparisonoperator(>),value)
- This is more complex ```   $apps= DB::table('apps')->select('title')->where('created_at','<',now()->subDay())->orWhere('title','Prof.')->get();  ```

- WHERE between method. Scope between 5 to 9 ```          $apps= DB::table('apps')->select('title')->whereBetween('id',[5,9])->get(); ```

- check if not Notnull. ```        $apps= DB::table('apps') ->whereNotNull('created_at')->get(); ```
- whereRaw. Not recommended. Gets the raw unescaped string. 
- distinct. Get all distinct data. ```    $apps= DB::table('apps')->select('title')->distinct()->get(); ```
- orderby ```    $apps= DB::table('apps')->orderBy('title','asc')->get(); ```
- sort ```    $apps= DB::table('apps')->latest()->get(); ``` is based on created_at on descending order. Replace ```latest``` to ```oldest``` to get it ascending. or ```inRandomOrder()``` to get it random.
- Returning Methods.
- replacing ```get()``` to ```first()``` to get the head. Limit(1).
- find id by replacing ```get()``` to ``find($id)``. When empty, a ````null``` is returned.
- to get the count of the query found. Replace ```get()``` to ``` count() ```
- to get minimum, Replace ```get()``` to ``` min($id) ``` to max, just replace ```min``` to ```max```.
- to get the sum/average. Do this ```    $apps= DB::table('apps')->avg('id'); ``` . Replace ```avg()``` to ``` sum($id) ``` to max
10. Inserting to Database. ```         $apps= DB::table('apps')->insert(['title'=> 'New Post','body'=>'New body']); ```
11. Update the table 
```         
$apps= DB::table('apps')
        ->where('id','=',10)->update(['title'=>'asdsad title','body'=>'asda yarn']); 
```
12. Delete the query by ```$apps= DB::table('apps')->where('id','=',10)->delete(); ```
### ELOQUENT 


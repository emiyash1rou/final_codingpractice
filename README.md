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
- AN ORM. Object Relational Manner.
- Simplicity is Eloquent's Focus.
- Relies on convention over configuration. (Minimal Code)
- Make a model and migrate it ``` php artisan make:model Mineral -m ```
- Create a resource controller by doing ``` php artisan make:controller MineralsController --resource ```
- see your route list by doing ``` php artisan route:list ```
- Link your resource in web.php using ``` Route::resource('/',MineralsController::class); ``` Don't forget to import it using ``` use App\Http\Controllers\MineralsController; ```
- difference between resource controller and controller is that you don't need to define routes in resourcecontroller since they will be defined in the resouce whereas controller alone, you need to define them in the web.php.
- You can change model by going to its model to define. Default behavior of table name is snake cases and pluralize your class name. Manipulate it by adding a property ``` protected $table = 'minerals'; // overrides the table name to minerals ```
- change primary key by creating new property ``` protected $primaryKey='name'; ``` or you can just delete it in ``` protected $primaryKey=null; ```
- create new property that disable the $timestamp by ``` protected $timestamps=false; ``` or you can customize the format by ``` protected $dateFormat='h:m:s'; ```
- These are all optional
1. Retrieve data with Eloquent. 
- Import the Model in your MineralsController. ``` use App\Models\Mineral; ```
- Perform a select * by creating a variable and get Object and .all() 
```
  public function index()
    {
        $minerals=Mineral::all();
        dd($minerals);
       return view('minerals.index');
    }
```
- similar to facade db  ```  $minerals=Mineral::where('title','=','first mineral')->get(); ```
2. Breaking down request to chunks makes us avoid memory/locking issues.
- Method to break request to smaller pieces.
- chunk(amountofrowswhereyouwanttochunk, function(){

})
``` 
$minerals=Mineral::chunk(2,function($minerals){
            foreach($minerals as $mineral){
                print_r($mineral);
            }
        });
```
- Performing 2 queries of 2 rows. Probs splitting the database into two and doing the command query.
```
  public function index()
    {
        // $minerals=Mineral::all();
        $minerals=Mineral::where('title','=','first mineral')->get();

        $minerals=Mineral::chunk(2,function($minerals){
            foreach($minerals as $mineral){
                print_r($mineral);
            }
        });
```
- if no model is found, throw an exception by using firstorfail ```       $minerals=Mineral::where('title','=','first mineral')->firstOrFail(); ``` note: returns a single json format. foreach is not applicable. rather use $minerals->title or $minerals['title']
3. Save function Create Functionality. 
```
 public function store(Request $request)
    {
        //
        $mineral=new Mineral;
        $mineral->name=$request->input('name_of_minerals');
        $mineral->save();
    }

```
- Other way through passing array is ```         $mineral= Mineral::create(['name_of_minerals'=>$request->input('name_of_minerals')]); ``` but you need to assign the mass assignment by going to your model and assigning ``` protected $fillable = ['name_of_minerals']; ```
- $fillable=[columns that can be massed assigned, consistent ilang form names until db columns]
- Additional! You can replace Mineral::create() to Mineral::make() but it doesn't automatically save it. You need to call ->save() to save it.
4. Read Functionality 
```
```

5. Update Functionality
```
  public function update(Request $request, $id)
    {
        //
        $mineral= Mineral::where('id',$id)->update(['name_of_minerals'=>$request->input('name_of_minerals')]);
        return redirect('/minerals');
    }

```
6. Destroy Functionality
```
  public function destroy($id)
    {
        //
        $mineral= Mineral::find($id)->first();
        $mineral->delete();
        return redirect('/minerals');
    }
```
7. Eloquent Serialization
- Returning multiple rows returns a collection which is an array with steroids.
- ORM falls short with Serializaiton. 
- CLEAR laravel code in index.blade.php becasuse we are not going to be using arrays anymore.
- Laravel only uses JSON for API's. Collections are converted to array.
- If you want to use Json then you need to decode it.
- To decode use:
```
    public function index()
    {
      
        $minerals=Mineral::all()->toJson();
        $minerals=json_decode($minerals);
        var_dump($minerals);
       return view('minerals.index',['minerals'=>$minerals]);

    }
    // change toJson to toArray() and clear json_decode if you want it to be array.

```
- to hide some values to be retrieved then in your model user ``` protected $hidden=['password','retrieve_token']; ``` the opposite of it would be to whitelist them by using  ``` protected $visible=['title','description']; ```
- To immediately pass model inside of method
- From this...
```
public function destroy($id)
    {
        //
        $mineral= Mineral::find($id)->first();
        $mineral->delete();
        return redirect('/minerals');
    }
```
- to this...
```
public function destroy(Mineral $mineral)
    {
        $mineral->delete();
        return redirect('/minerals');
    }
```

- it saves code and time since you don't need to get it.
8. Eloquent - Relationships
- Tables that are related to each other.
- One to Many Relationship
- Mineral_Specification unique_id with timestamps
- 2 Ways to handle migration.
- Handle in one existing migration or add code in existing migration. Former is easier but latter is recommended.
- In your migrations create_minerals code enter
```
  Schema::create('specification', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mineral_id');
            $table->string('specification_name');
            $table->timestamps();
            $table->foreign('mineral_id')->references('id')->on('minerals')->onDelete('cascade');
        });
```
- where mineral_id is referenced from a table id on minerals. Cascade deletes whenever a primary key referenced is deleted. Like if you delete a mineral, obviously, the records of the pertaining specifications should be deleted as well.
- NOTE: you can replace cascade onto 'set null' to set null the referenced keys and not cause it to be deleted.
- migrate it. ``` php artisan migrate:rollback ``` then ``` php artisan migrate ```
- Declaring show model. 
+--------------------+------------------+------+-----+---------+----------------+
| Field              | Type             | Null | Key | Default | Extra          |
+--------------------+------------------+------+-----+---------+----------------+
| id                 | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| mineral_id         | int(10) unsigned | NO   | MUL | NULL    |                |
| specification_name | varchar(255)     | NO   |     | NULL    |                |
| created_at         | timestamp        | YES  |     | NULL    |                |
| updated_at         | timestamp        | YES  |     | NULL    |                |
+--------------------+------------------+------+-----+---------+----------------+
- MUL basically shows that these key can exist multiple.
- Now, we need to create the specification model since a mineral can have multiple mineral specifications but there can only be one mineral in a specification.So what we need to do is have a model. ``` php artisan make:model MineralSpecification ```. 
- Then on your main model. The Mineral Model. Define the relationship between the Mineral and MineralSpecifications.
```

    public function mineralSpecifications(){
        return $this->hasMany(MineralMode::class);

    }
```
- Then establish the relationship between MineralSpecification and Mineral by:
```
class MineralSpecification extends Model
{
    use HasFactory;
    protected $table='specification';
    protected $primaryKey='id';
    // A mineral specification belongs to a mineral.

    public function mineral(){
        return $this->belongsTo(Mineral::class);
    }
}
```
- Call the function to access its data by calling the function from the connected Model to retrieve foreign key details.
```
        <tbody>
                                     
                                        @forelse($minerals->mineralSpecifications as $each_mineral)
                                
                                        <tr>
                                            <td class="cell">{{$each_mineral->id}}</td>
                                            <td class="cell"><span class="truncate">{{$each_mineral->specification_name}}</span></td>
                                            <td class="cell">{{$each_mineral->created_at}}</td>
                                            <td class="cell"><span class="cell-data">{{$each_mineral->updated_at}}</td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="/minerals/{{$each_mineral->id}}/show">View</a></td>
                                           
                                        </tr>
                                        @empty
                                        <tr><td colspan="12">No Specification record collected.&nbsp; <a href="/minerals/caryl">Create one here.</a></td>
                                        @endforelse
                                        

    
                                    </tbody>
```
- PAGINATION in laravel
- Put pagination in your code retrieval. There are two ways
```
        // Pagination Path Query Builder
         $minerals=DB::table('minerals')->paginate(4);
        // endpagination
        // Pagination Eloquent
        $minerals= Mineral::paginate(3);
```
- To create your custom pagination access app/Providers/AppServiceProviders.php and import ``` use Illuminate\Pagination\Paginator; ``` and then allow methhod boot to use Bootstrap. by inserting in boot method ```    Paginator::useBootstrap(); ```
- Don't forget to import bootstrap in your CDN in your website.
# STOPPED AT 4:50 . MANY TO MANY ELOQUENT DOESN'T APPLY ATM.
- HasMany Relationship. 
- Create a model and migration ``` php artisan make:model Engine -m```
- Then in your migrations declare your variables
```
 Schema::create('engines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('model_id');
            $table->string('specification_name');
            $table->timestamps();
            $table->foreign('model_id')->references('id')->on('specification')->onDelete('cascade');
        });
```
- add data in engines table.
- we dont need to do anything in our engines model. instead go to the minerals model and put this. Because Minerals->
```
public function engines(){
        return $this->hasManyThrough(Engine::class,ModelSpecification::class);

    }
```
- hasManyThrough(tablethatweneedtoaccess,modelthatweneedinordertoaccesstheengine). Ang table na need tapos ang model na naay relation sa engine
- Ang mineral <img src="readmeImages/hasMany.png">

# SKIPPED TO 5:14 REQUESTS







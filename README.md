# AALA IT Solution Test Steps

## Step 1 : Project Setup
* Create project by using this command
```composer create-project laravel/laravel:^10.0 aala-it-solutions```
* Create fork from `https://github.com/aalasolutions/laravel-test`
* Install Laravel Sanctum by following commands
-```composer require laravel/sanctum```
-```php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"```
-```php artisan migrate```
* Override file `app/Http/Kernel.php` 'api' array with the following code
```
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

## Step 2 : Database
* Create migration for table `tasks`
* Added given columns into migration
* Run the migration

## Step 3 : Models and Relationship
* Create Model `Task`
* Added below code into `Task` Model
``` 
public function user()
    {
        return $this->belongsTo(User::class);
    }
```
* Added below code into `User` Model
```
public function tasks()
    {
        return $this->hasMany(Task::class);
    }
```

## Step 4 : Controller And Api Logic
* Create controller `TaskController`
* Added these methods in controller `(index, store, show, update destroy)`
* End Points
* Getting My Tasks
  - ```http://localhost:8000/api/tasks``` Method `GET`
* Create New Task
  - ```http://localhost:8000/api/tasks``` Method `POST`
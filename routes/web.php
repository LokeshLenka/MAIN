<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Profile_Controller;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TokenIsValidController;
use App\Http\Middleware\TokenIsValid;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExampleRequestController;
use App\Http\Controllers\FollowControllers;
// use Closure;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');





// uses the middleware in all the 3 routes below
// Route groups allow you to share route attributes, such as middleware,Controllers,Sub-Domains
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/basic', function () {
    return view('basic', [
        'title' => 'Basic Page',
        'called' => 'called "basic" route'
    ]);
});
// routes used in pratcing

Route::get('/nav', function () {
    return view('layouts.nav');
});

Route::get('/theme', function () {
    return view('theme');
});


Route::get('/publish', function () {
    return view('publish');
})->middleware('auth')->name('publish');

Route::post('/publish', [PublishController::class, 'store'])->name('publish.store');
// });


Route::get('/ip', function () {
    //
})->middleware(TokenisValid::class);

// Route::post('/publish', [PublishController::class, 'store'])->name('publish.store');

Route::get('/tokencheck', [TokenIsValidController::class, 'index'])->middleware('TokenIsValid');

Route::post('/publishtoken', [TokenIsValidController::class, 'store'])->middleware(['auth'])->name('tokens.store');

Route::get('/publishtoken', [TokenIsValidController::class, 'show'])->middleware('auth')->name('tokens.show');


Route::get('/todo', [TodoController::class, 'index'])->middleware(['auth'])->name('todo');

Route::post('/todo', [TodoController::class, 'store'])->middleware(['auth'])->name('todo.store');

//

// returns a view based on the url
Route::view('/users', 'basic');

// redirects into other route
Route::redirect('users', 'basic');

// parameters passed along with url with expressions constraints
Route::get('/user/{id?}', function (string $id) {
    return view('basic', ['id' => $id]);
})->where('id', '[0-9A-Za-z]+');
// '[0-9]+[A-Z]+[a-z]+' specifies the position of alphanumerics

// shortand or convience method for above

Route::get('/user/{id?}', function (string $id) {
    return view('basic', ['id' => $id]);
})->whereAlphaNumeric('id');

// Route::get('/home/{id?}', function (string $id) {
//     return view(
//         'home',
//         ['id' => $id]
//     );
// });


// Route Prefixes
Route::prefix('testuser')->group(function () {

    // Named routes (view file of page1.blade.php to see the one of the use case)

    Route::get('/page1/{id?}', function (string $id = null) {
        return view('page1', [
            'id' => $id
        ]);
    })->name('page1');

    Route::get('/page2/{id?}', function (string $id = null) {
        return view('page2', [
            'id' => $id
        ]);
    })->name('page2');
});


// Route model binding
// Route::get('/posts/{post?}', [PostController::class, 'show'])->name('posts.show');

// Route fallback - if a request doesn't matches above routes,then this fallback is executed
// and this should be the last route defined in web.php
// Route::fallback(function(){
//     return view('404');
// });


/*
---------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------
*/


Route::resource('bloguser', BlogUserController::class);

Route::get('/allusers', [BlogUserController::class, 'showAllUsers'])->name('bloguser.alluser');
Route::post('/allusers', [BlogUserController::class, 'followUser'])->name('followUser');
// Route::post('/allusers', [BlogUserController::class, 'unFollowUser'])->name('unFollowUser');


Route::resource('blog', BlogController::class)->middleware('auth');

// Route::middleware('auth')->group(function () {
//     Route::post('/follow/{id}', [BlogUserController::class, 'update'])->name('bloguser.update');
// });





// Route::get('/follow', [FollowControllers::class, 'follow'])->name('follow');
// Route::post('/ausers}', [FollowControllers::class, 'follow'])->name('follow');
// Route::delete('/unfollow/{user}', [FollowControllers::class, 'unfollow'])->name('unfollow');
// Route::get('/users/{user}/followers', [FollowControllers::class, 'followers'])->name('followers');
// Route::get('/users/{user}/following', [FollowControllers::class, 'following'])->name('following');


// Route::get('/ausers', [FollowControllers::class, 'userDirectory'])
//     ->name('user.directory')
//     ->middleware('auth');

// Route::get('/users')








Route::get('/lokesh', [ExampleRequestController::class, 'show']);
Route::get('/loki', [ExampleRequestController::class, 'psrget'])->name('psrget');
Route::post('/loki', [ExampleRequestController::class, 'psrpost'])->name('psrpost');



require __DIR__ . '/auth.php';

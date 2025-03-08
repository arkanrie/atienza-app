<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Services\ProductService;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use PhpParser\Node\Stmt\Echo_;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-container', function (Request $request) {
    return $request->input('key');
});

Route::get('/test-provider', function () {
    $userService = app(UserServices::class);
    return $userService->listUsers();
});

Route::get('/test-users', [UserController::class, 'index']);

Route::get('/test-facade', function () {
    $userService = app(UserServices::class);
    return response()->json($userService->listUsers());
});

Route::get('/post/{post}/comment/{comment}', function(string $postID, string $comment){
    return "Post ID: ". $postID ."_Comment: ". $comment;

});

Route::get('/post/{id}', function(string $id) {
    return $id;
})->where('id','[0-9]+');

Route::get('/search/{search}', function (string $search) {
    return $search;
})->where ('search', '.*');

//name route or route alias
Route::get('/test/route', function (){
    return route('test-route');
})->name('test-route');

//route -> middleware group

Route::middleware(['user-middleware'])->group(function() {
    Route::get('route-middleware-group/first',function(Request $request){
        echo 'first';
    });
    Route::get('route-middleware-group/second',function(Request $request){
        echo 'second';
    });
    
});

//rute->controller
    Route::controller(UserController::class)->group(function (){
        Route::get('/users', 'index');
        Route::get('/users/first', 'first');
        Route::get('/users/{id}', 'show');

    });
// CSRF
Route::get('/token', function (Request $request){
    return view('token');
});

Route::post('/token', function (Request $request){
    return $request->all();
});


//controller -> Middleware

Route::get('/users', [UserController::class,'index'])->middleware('user-middleware');
//resources
Route::resource('products', ProductController::class);

//view data

Route::get('/product-list',function(ProductService $productService){
    $data['products'] = $productService->listProducts();
    return view ('product.list', $data);
});




  



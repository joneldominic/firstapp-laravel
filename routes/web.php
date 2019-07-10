<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');








/*
***Route Stash***
//Note: View should not be in the route.

//Satic Route

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function(){
    return view('pages.about'); // "." for heirarchy
});

Route::get('/hello', function () {
    return '<h1>Hello World!</h1>';
});

//Dynamic Route
//id serves as passed parameter 
//passing double parameters
Route::get('/users/{id}/{name}', function($id, $name){
    return 'This is user '.$name.' with an id of '.$id; // "." for heirarchy
});


*/
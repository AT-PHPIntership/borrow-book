<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('checkAccessToken', 'API\LoginController@checkAccessToken');
    Route::delete('books/{book}/posts/{post}', 'API\PostController@destroy');
});

Route::post('login', 'API\LoginController@login');
Route::post('register', 'API\LoginController@register');
Route::get('books', 'API\BookController@index');
Route::get('categories', 'API\CategoryController@index');
Route::get('books/{book}', 'API\BookController@show');
Route::get('books/{book}/posts', 'API\PostController@getPostFollowingBook');

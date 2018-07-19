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
    Route::delete('posts/{post}', 'API\PostController@destroy');
    Route::post('books/{book}/posts', 'API\PostController@store');
    Route::put('posts/{post}', 'API\PostController@update');
    Route::post('logout','API\LoginController@logout');
    Route::post('borrow','API\BorrowController@store');
    Route::put('borrow/{borrow}','API\BorrowController@cancel');
    Route::get('users/profile','API\UserController@profile');
    Route::get('users/posts', 'API\UserController@getPost');
    Route::get('users/borrow', 'API\BorrowController@index');
    Route::post('favorites','API\FavoriteController@store');
    Route::get('users/favorites','API\FavoriteController@index');
    Route::put('users/favorites/{favorite}','API\FavoriteController@update');
    Route::delete('favorites/{favorite}', 'API\FavoriteController@destroy');
});

Route::post('login', 'API\LoginController@login');
Route::post('register', 'API\LoginController@register');
Route::get('books', 'API\BookController@index');
Route::get('categories', 'API\CategoryController@index');
Route::get('books/{book}', 'API\BookController@show');
Route::get('books/{book}/posts', 'API\PostController@getPostFollowingBook');
Route::post('password/reset', 'API\ForgotPasswordController@sendResetLinkEmail');
Route::put('password/reset', 'API\ResetPasswordController@reset');

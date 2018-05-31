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
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

$admin_config = [
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as'=> 'admin.',
    'middleware' => 'admin'
];
Route::group($admin_config, function(){
    Route::get('/', 'HomeController@index');
    Route::resource('users', 'UserController');
    Route::resource('books', 'BookController');
    Route::resource('borrows', 'BorrowController');
    Route::resource('images', 'ImageBookController');
    Route::resource('posts', 'PostController');
    Route::put('borrows/{borrow}/updateStatus', 'BorrowController@updateStatus')->name('borrows.updateStatus');
    Route::resource('categories', 'CategoryController');
});
Route::post('active',[
            'uses'=>'Admin\PostController@active',
            'as' => 'admin.post.active'
]);

Auth::routes();

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
});

$admin_config = [
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as'=> 'admin.',
];
Route::group($admin_config, function(){
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('users', 'UserController');
    Route::resource('books', 'BookController');
    Route::resource('borrows', 'BorrowController');
});

Auth::routes();

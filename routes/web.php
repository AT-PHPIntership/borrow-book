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

Route::get('/api-docs', function () {
    return view('api-docs');
});
Route::get('/api-doc-builders', function () {
    return view('api-docs-builders.index');
});

$admin_config = [
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as'=> 'admin.',
    'middleware' => ['auth:web','admin']
];
Route::group($admin_config, function(){
    Route::get('/', 'HomeController@index');
    Route::resource('users', 'UserController');
    Route::resource('books', 'BookController');
    Route::post('books/read-barcode', 'BookController@readBarcode')->name('readBarcode');
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

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

Route::get('login', 'User\Auth\LoginController@showLoginForm')->name('login');
Route::get('register', 'User\Auth\LoginController@showRegisterForm')->name('register');
Route::get('cart', 'CartController@index')->name('cart');
Route::resource('books', 'BookController')->except([
    'store', 'update', 'destroy'
]);
Route::get('profile', 'UserController@index')->name('profile');
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

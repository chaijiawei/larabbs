<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('phpinfo', function() {
   phpinfo();
});

Route::get('/', 'PagesController@index')->name('home');

Route::resource('users', 'UsersController');

Route::resource('topics', 'TopicsController')->except('show');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::middleware(['throttle:60,1'])
    ->post('topics/upload', 'TopicsController@upload')
    ->name('topics.upload');

Route::resource('categories', 'CategoriesController')->only('show');

Route::resource('replies', 'ReplyController')->only(['store', 'destory']);

Route::get('notifications', 'NotificationController@show')->name('notification.show');

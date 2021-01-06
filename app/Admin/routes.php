<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('roles', RoleController::class);
    $router->resource('permissions', PermissionController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('topics', TopicController::class);
    $router->resource('replies', ReplyController::class);
    $router->resource('links', LinkController::class);
});

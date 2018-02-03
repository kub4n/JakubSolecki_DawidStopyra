<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->bind('category', function ($id) {
    return app(\Modules\Blog\Repositories\CategoryRepository::class)->find($id);
});
$router->bind('post', function ($id) {
    return app(\Modules\Blog\Repositories\PostRepository::class)->find($id);
});
$router->bind('reservation', function ($id) {
    return app(\Modules\Blog\Repositories\ReservationRepository::class)->find($id);
});

$router->group(['prefix' => '/blog'], function (Router $router) {
    $router->get('posts', [
        'as' => 'admin.blog.post.index',
        'uses' => 'PostController@index',
        'middleware' => 'can:blog.posts.index',
    ]);
    $router->get('posts/create', [
        'as' => 'admin.blog.post.create',
        'uses' => 'PostController@create',
        'middleware' => 'can:blog.posts.create',
    ]);
    $router->post('posts', [
        'as' => 'admin.blog.post.store',
        'uses' => 'PostController@store',
        'middleware' => 'can:blog.posts.create',
    ]);
    $router->get('posts/{post}/edit', [
        'as' => 'admin.blog.post.edit',
        'uses' => 'PostController@edit',
        'middleware' => 'can:blog.posts.edit',
    ]);
    $router->put('posts/{post}', [
        'as' => 'admin.blog.post.update',
        'uses' => 'PostController@update',
        'middleware' => 'can:blog.posts.edit',
    ]);
    $router->delete('posts/{post}', [
        'as' => 'admin.blog.post.destroy',
        'uses' => 'PostController@destroy',
        'middleware' => 'can:blog.posts.destroy',
    ]);

    $router->get('reservations', [
        'as' => 'admin.blog.reservation.index',
        'uses' => 'ReservationController@index',
        'middleware' => 'can:blog.reservations.index',
    ]);
    $router->get('reservations/create', [
        'as' => 'admin.blog.reservation.create',
        'uses' => 'ReservationController@create',
        'middleware' => 'can:blog.reservations.create',
    ]);
    $router->post('reservations', [
        'as' => 'admin.blog.reservation.store',
        'uses' => 'ReservationController@store',
        'middleware' => 'can:blog.reservations.create',
    ]);
    $router->get('reservations/{reservation}/edit', [
        'as' => 'admin.blog.reservation.edit',
        'uses' => 'ReservationController@edit',
        'middleware' => 'can:blog.reservations.edit',
    ]);
    $router->put('reservations/{reservation}', [
        'as' => 'admin.blog.reservation.update',
        'uses' => 'ReservationController@update',
        'middleware' => 'can:blog.reservations.edit',
    ]);
    $router->delete('reservations/{reservation}', [
        'as' => 'admin.blog.reservation.destroy',
        'uses' => 'ReservationController@destroy',
        'middleware' => 'can:blog.reservations.destroy',
    ]);
});

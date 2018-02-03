<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'apartamenty'], function (Router $router) {
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
    $router->get('lista', [
        'as' => $locale . '.blog',
        'uses' => 'PublicController@index',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
    $router->get('lista/{slug}', [
        'as' => $locale . '.blog.slug',
        'uses' => 'PublicController@show',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
    $router->post('lista/{post}/rezerwacja', [
        'as' => $locale . '.blog.post.reserve',
        'uses' => 'PublicController@reserve',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
});

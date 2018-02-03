<?php

return [
    'blog.posts' => [
        'index' => 'blog::post.list resource',
        'create' => 'blog::post.create resource',
        'edit' => 'blog::post.edit resource',
        'destroy' => 'blog::post.destroy resource',
    ],
    'blog.categories' => [
        'index' => 'blog::category.list resource',
        'create' => 'blog::category.create resource',
        'edit' => 'blog::category.edit resource',
        'destroy' => 'blog::category.destroy resource',
    ],
    'blog.reservations' => [
        'index' => 'blog::reservations.list resource',
        'create' => 'blog::reservations.create resource',
        'edit' => 'blog::reservations.edit resource',
        'destroy' => 'blog::reservations.destroy resource',
    ],
];

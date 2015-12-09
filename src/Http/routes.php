<?php

Route::group(['namespace' => 'Taskforcedev\Blog\Http\Controllers'], function() {

    /* Get the route base from configuration */

    $location = config('taskforce-blog.location', 'home');
    $blogBase = "/";
    /* Config Conditional Routes */
    switch ($location) {
        case 'home':
            $blogBase = '/';
            break;
        case 'blog':
            $blogBase = '/blog/';
            break;
        case 'news':
            $blogBase = '/news/';
            break;
        default:
            break;
    }

    /* PUBLIC ROUTES */

    Route::get($blogBase, ['as' => 'blog.index', 'uses' => 'BlogController@blog']);
    Route::get($blogBase . 'post/{$id}', ['as' => 'blog.post.view', 'uses' => 'BlogController@viewPost']);

    /* ADMIN */
    Route::get('admin/blog', ['as' => 'blog.admin.index', 'uses' => 'AdminController@index']);
    Route::get('admin/blog/post', ['as' => 'blog.admin.index', 'uses' => 'AdminController@postForm']);

    Route::post('admin/blog/post', ['as' => 'blog.post.create', 'uses' => 'AdminController@createPost']);;

    /* SYNDICATION */

    $rss = config('taskforce-blog.feeds.rss', true);
    $atom = config('taskforce-blog.feeds.atom', true);

    if ($rss) {
        Route::get('feed.rss', ['as' => 'blog.rss.index', 'uses' => 'BlogController@blogRSS']);
    }

    if ($atom) {
        Route::get('feed.atom', ['as' => 'blog.atom.index', 'uses' => 'BlogController@blogAtom']);
    }
});

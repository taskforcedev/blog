<?php

Route::group(['namespace' => 'Taskforcedev\Blog\Http\Controllers'], function() {

    $location = config('taskforce-blog.location', 'home');

    $rss = config('taskforce-blog.feeds.rss', true);
    $atom = config('taskforce-blog.feeds.atom', true);

    if ($rss) {
        Route::get('feed.rss', ['as' => 'blog.rss.index', 'uses' => 'BlogController@blogRSS']);
    }

    if ($atom) {
        Route::get('feed.atom', ['as' => 'blog.atom.index', 'uses' => 'BlogController@blogAtom']);
    }

    /* Config Conditional Routes */
    switch ($location) {
        case 'home':
            Route::get('/', ['as' => 'blog.index', 'uses' => 'BlogController@blog']);
            Route::get('post/{$id}', ['as' => 'blog.post.view', 'uses' => 'BlogController@viewPost']);
            break;
        case 'blog':
            Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@blog']);
            Route::get('blog/post/{$id}', ['as' => 'blog.post.view', 'uses' => 'BlogController@viewPost']);
            break;
        default:
            break;
    }

    /* Admin Routes */
    Route::get('admin/blog', ['as' => 'blog.admin.index', 'uses' => 'AdminController@index']);
    Route::get('admin/blog/post', ['as' => 'blog.admin.index', 'uses' => 'AdminController@postForm']);

    Route::post('admin/blog/post', ['as' => 'blog.post.create', 'uses' => 'AdminController@createPost']);;
});

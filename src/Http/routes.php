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
    switch ($location)
    {
        case 'home':
            Route::get('/', ['as' => 'blog.index', 'uses' => 'BlogController@blog']);
            break;
        case 'blog':
            Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@blog']);
            break;
        default:
            Route::get('/', ['as' => 'blog.index', 'uses' => 'BlogController@blog']);
            break;
    }
});

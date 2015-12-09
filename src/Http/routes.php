<?php

Route::group(['namespace' => 'Taskforcedev\Blog\Http\Controllers'], function() {

    $location = config('taskforce-blog.location');
    $blogBase = "/blog/";

    /* Config Conditional Routes */
    switch ($location)
    {
        case 'home':
            $blogBase = "/";
            break;
        case 'blog':
            $blogBase = "/blog/";
            break;
        case 'news':
            $blogBase = "/news/";
            break;
        default:
            break;
    }

    Route::get($blogBase, ['as' => 'blog.index', 'uses' => 'BlogController@blog']);
});

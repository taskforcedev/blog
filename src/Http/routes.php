<?php

Route::group(['namespace' => 'Taskforcedev\Blog\Http\Controllers'], function() {

    $location = config('taskforce-blog.location');

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
            break;
    }

});

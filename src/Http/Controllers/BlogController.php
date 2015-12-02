<?php namespace Taskforcedev\Blog\Http\Controllers;

use Taskforcedev\LaravelSupport\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function blog()
    {
        $data = $this->buildData();

        return view('taskforce-blog::index', $data);
    }

    public function viewPost()
    {
        $data = $this->buildData();

        return view('taskforce-blog::post', $data);
    }
}

<?php namespace Taskforcedev\Blog\Http\Controllers;

use Illuminate\Http\Request;
use \Exception;
use Taskforcedev\Blog\Models\Post;
use Taskforcedev\Blog\Helpers\Installation;
//use Taskforcedev\Blog\Helpers\CSS\Bootstrap3;
use Taskforcedev\Blog\Helpers\CSS\Bootstrap4;
use Taskforcedev\Blog\Helpers\CSS\Foundation5;

class AdminController extends BaseController
{
    public function __construct()
    {
        Installation::checkOrRunMigrations();
    }
}

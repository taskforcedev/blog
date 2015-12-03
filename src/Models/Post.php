<?php namespace Taskforcedev\Blog\Models;

use \Exception;
use \Validator;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [ 'title', 'author_id', 'body', 'status_id', 'image' ];
}

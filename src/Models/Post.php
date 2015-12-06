<?php namespace Taskforcedev\Blog\Models;

use \Exception;
use \Validator;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [ 'title', 'author_id', 'body', 'status_id', 'image' ];

    public function scopeDrafts($query)
    {
        $status = Status::getStatusByName('draft');

        return $query->where('status_id', $status->id);
    }

    public function scopeLatest($query, $count)
    {
        return $query
            ->orderBy('created_at', 'desc')
            ->take($count);
    }

    public function scopePublished($query)
    {
        $status = Status::getStatusByName('published');

        return $query->where('status_id', $status->id);
    }
}

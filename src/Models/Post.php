<?php namespace Taskforcedev\Blog\Models;

use \Exception;
use \Validator;
use Illuminate\Database\Eloquent\Model;
use Taskforcedev\LaravelSupport\Helpers\User as UserHelper;

/**
 * Class Post
 * @package Taskforcedev\Blog\Models
 */
class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [ 'title', 'author_id', 'body', 'status_id', 'image' ];

    public function author()
    {
        /* Get the user model. */
        $userHelper = new UserHelper();
        $model = $userHelper->getUserModel();

        return $this->belongsTo($model);
    }

    /**
     * Get posts with a status of 'draft'.
     * @param $query
     * @return mixed
     */
    public function scopeDrafts($query)
    {
        $status = Status::getStatusByName('draft');

        return $query->where('status_id', $status->id);
    }

    /**
     * Get the latest n number of posts.
     * @param $query
     * @param $count
     * @return mixed
     */
    public function scopeLatest($query, $count)
    {
        return $query
            ->orderBy('created_at', 'desc')
            ->take($count);
    }

    /**
     * Get posts with a status of 'published'
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        $status = Status::getStatusByName('published');

        return $query->where('status_id', $status->id);
    }
}

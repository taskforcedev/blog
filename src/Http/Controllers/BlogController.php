<?php namespace Taskforcedev\Blog\Http\Controllers;

use \Exception;
use Taskforcedev\Blog\Models\Post;
use Taskforcedev\Blog\Models\Status;
use Taskforcedev\LaravelSupport\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Blog index.
     * @return mixed
     */
    public function blog()
    {
        $data = $this->buildData();
        $status = Status::getStatusByName('published');

        try {
            $posts = Post::where('status_id', $status->id)->get();
            $data['posts'] = $posts;
            return view('taskforce-blog::index', $data);
        } catch (Exception $e) {
            $data['error'] = $e->getMessage(); // TODO: implement logic to only show this to admins.
            return view('taskforce-blog::error', $data);
        }
    }

    /**
     * View an individual post.
     *
     * @param integer $id Post Id.
     *
     * @return mixed
     */
    public function viewPost($id)
    {
        $data = $this->buildData();

        try {
            $data['post'] = Post::where('id', $id);
            return view('taskforce-blog::post', $data);
        } catch (Exception $e) {
            return view('taskforce-blog::404', $data);
        }
    }
}

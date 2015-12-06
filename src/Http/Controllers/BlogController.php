<?php namespace Taskforcedev\Blog\Http\Controllers;

use \Exception;
use Taskforcedev\Blog\Models\Post;
use Taskforcedev\Blog\Models\Status;
use Taskforcedev\Blog\Helpers\CSS\Bootstrap4;
//use Taskforcedev\Blog\Helpers\CSS\Bootstrap3;
use Taskforcedev\Blog\Helpers\Installation;
use Taskforcedev\Blog\Helpers\CSS\Foundation5;
use Taskforcedev\LaravelSupport\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        Installation::checkOrRunMigrations();
    }

    /**
     * Blog index.
     * @return mixed
     */
    public function blog()
    {
        $data = $this->buildBlogData();
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
        $data = $this->buildBlogData();

        try {
            $data['post'] = Post::where('id', $id)->firstOrFail();
            return view('taskforce-blog::post', $data);
        } catch (Exception $e) {
            return view('taskforce-blog::404', $data);
        }
    }

    /**
     * Uses the buildData from the Support Package, then adds blog css classes and framework choice.
     *
     * @return mixed
     */
    private function buildBlogData()
    {
        $data            = $this->buildData();
        $data['classes'] = $this->getCssClasses();

        return $data;
    }

    /**
     * Get the CSS classes to be used by the blog views.
     *
     * @return array
     */
    private function getCssClasses()
    {
        $framework = $this->getFramework();
        $postLayout = $this->getPostLayout();

        switch ($framework)
        {
            case 'bootstrap-3':
                return [
                    'post'           => 'post',
                    'title'          => 'post-title',
                    'featured-image' => 'post-image',
                ];
            case 'bootstrap-4':
                $helper = new Bootstrap4($postLayout);
                return $helper->getBlogClasses();
            case 'foundation-5':
                return [
                    'post'           => 'post',
                    'title'          => 'post-title',
                    'featured-image' => 'post-image',
                ];
            default:
                return [
                    'post'           => 'blog-post',
                    'title'          => 'post-title',
                    'featured-image' => 'post-image',
                ];
        }
    }

    /**
     * Get the post-layout chosen in config or default in case of error.
     * @return string
     */
    private function getPostLayout()
    {
        try {
            $postLayout = config('taskforce-blog.post-layout');
            if (isset($postLayout)) {
                return $postLayout;
            }
        } catch (Exception $e) {
            return 'list';
        }
        return 'list';
    }

    /**
     * Get the framework chosen in config or default in case of error.
     * @return string
     */
    private function getFramework()
    {
        try {
            $config = config('taskforce-blog.framework');
            if (isset($config)) {
                return $config;
            }
        } catch (Exception $e) {
            return 'bootstrap-4';
        }
        return 'bootstrap-4';
    }
}

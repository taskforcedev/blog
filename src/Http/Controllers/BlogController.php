<?php namespace Taskforcedev\Blog\Http\Controllers;

use \Exception;
use Illuminate\Http\Request;
use Taskforcedev\Blog\Models\Post;
use Taskforcedev\Blog\Helpers\Syndication\Atom;
use Taskforcedev\Blog\Helpers\Syndication\RSS;

class BlogController extends BaseController
{
    /**
     * Blog index.
     * @return mixed
     */
    public function blog()
    {
        $data = $this->buildBlogData();

        try {
            $posts = Post::published()->get();
            $data['posts'] = $posts;
            return view($this->getViewFolder() . 'index', $data);
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
     * Creates an RSS feed of the most recent n posts.
     * @return mixed
     */
    public function blogRSS()
    {
        $rss = new RSS();
        return $this->renderFeed($rss);
    }

    /**
     * Creates an Atom feed of the most recent n posts.
     * @return mixed
     */
    public function blogAtom()
    {
        $atom = new Atom();
        return $this->renderFeed($atom);
    }

    /**
     * Provides shared code between Atom and RSS rendering.
     * @param object $feed The feed class to be used in output.
     * @return mixed
     */
    private function renderFeed($feed)
    {
        $options = [
            'items' => config('taskforce-blog.feeds.items')
        ];

        $output = $feed->renderHeader();

        try {
            $posts = Post::published()->latest($options['items'])->get();

            /* Add the posts to the RSS feed */
            foreach ($posts as $p) {
                $output .= $feed->renderPost($p);
            }
        } catch (Exception $e) {}

        $output .= $feed->renderFooter();

        return response($output)
            ->header('Content-Type', $feed->mimeType());
    }

    /**
     * Uses the buildData from the Support Package, then adds blog css classes and framework choice.
     *
     * @return mixed
     */
    private function buildBlogData()
    {
        return $this->buildData();
    }

    /**
     * Get the CSS classes to be used by the blog views.
     *
     * @return array
     */
    private function getViewFolder()
    {
        $framework = $this->getFramework();
        $postLayout = $this->getPostLayout();

        switch ($framework) {
            case 'bootstrap-3':
                return 'bootstrap3.' . $postLayout;
            case 'bootstrap-4':
                return 'bootstrap4.' . $postLayout;
            case 'foundation-6':
                return 'foundation6.' . $postLayout;
            default:
                return 'bootstrap4.' . $postLayout;
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

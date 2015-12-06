<?php namespace Taskforcedev\Blog\Http\Controllers;

use \Exception;
use Taskforcedev\Blog\Helpers\Installation;
use Taskforcedev\LaravelSupport\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        Installation::checkOrRunMigrations();
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
                $viewFolder = 'bootstrap3';
                break;
            case 'bootstrap-4':
                $viewFolder = 'bootstrap4';
                break;
            case 'foundation-6':
                $viewFolder = 'foundation6';
                break;
            default:
                $viewFolder = 'bootstrap4';
                break;
        }

        return 'taskforce-blog::' . $viewFolder . '.' . $postLayout;
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

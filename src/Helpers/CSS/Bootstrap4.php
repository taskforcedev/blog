<?php namespace Taskforcedev\Blog\Helpers\CSS;

class Bootstrap4 implements CssInterface
{
    public $postLayout;

    /**
     * Bootstrap4 constructor.
     *
     * @param $postLayout
     */
    public function __construct($postLayout)
    {
        $this->postLayout = $postLayout;
    }

    public function getBlogClasses()
    {
        switch ($this->postLayout)
        {
            case 'card':
                break;
            default:

        }
    }

}
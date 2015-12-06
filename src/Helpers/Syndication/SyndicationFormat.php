<?php namespace Taskforcedev\Blog\Helpers\Syndication;

/**
 * Interface SyndicationFormat
 * @package Taskforcedev\Blog\Helpers\Syndication
 */
interface SyndicationFormat
{
    public function renderHeader();

    public function renderPost($post);

    public function renderFooter();

    public function mimeType();
}

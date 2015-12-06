<?php namespace Taskforcedev\Blog\Helpers\Syndication;

class RSS implements SyndicationFormat
{
    public function renderHeader()
    {
        $data = $this->getConfig();

        return "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
        <rss version=\"2.0\">
            <channel>
                <title>{$data['title']}</title>
                <description>{$data['description']}</description>
                <link>{$data['rssUrl']}</link>";
    }

    public function renderPost($post)
    {
        $postUrl = route('blog.post.view', $post->id);
        $rssUrl = route('blog.rss.index');
        $blogName = config('taskforce-support.sitename');
        $authorEmail = $post->author->email;

        return "<item>
            <title>{$post->title}</title>
            <link>{$postUrl}</link>
            <description>{$post->title}</description>
            <pubDate>{$post->created_at}</pubDate>
            <source url=\"{$rssUrl}\">{$blogName}</source>
            <author>{$authorEmail}</author>
        </item>";
    }

    public function renderFooter()
    {
        return "</channel></rss>";
    }

    public function mimeType()
    {
        return 'application/rss+xml';
    }

    private function getConfig()
    {
        return [
            'rssUrl' => route('blog.rss.index'),
            'title' => config('taskforce-blog.feeds.title'),
            'description' => config('taskforce-blog.feeds.description'),
        ];
    }
}

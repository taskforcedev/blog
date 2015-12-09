<?php namespace Taskforcedev\Blog\Helpers\Syndication;

class Atom implements SyndicationFormat
{
    public function renderHeader()
    {
        $data = $this->getConfig();

        return "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
        <feed xmlns=\"http://www.w3.org/2005/Atom\">
            <channel>
                <title>{$data['title']}</title>
                <subtitle>{$data['description']}</subtitle>
                <link href=\"{$data['atomUrl']}\" rel=\"self\" />";
    }

    public function renderPost($post)
    {
        $postUrl = route('blog.post.view', $post->id);

        return "<entry>
		<title>{$post->title}</title>
		<link rel=\"alternate\" type=\"text/html\" href=\"{$postUrl}\"/>
		<id></id>
		<updated>{$post->updated_at}</updated>
		<summary>{$post->body}</summary>
		<content type=\"xhtml\">
			<div xmlns=\"http://www.w3.org/1999/xhtml\">
				{$post->body}
			</div>
		</content>
		<author>
			<name>{$post->author->name}</name>
			<email>{$post->author->email}</email>
		</author>
	</entry>";
    }

    public function renderFooter()
    {
        return "</feed>";
    }

    public function mimeType()
    {
        return 'application/atom+xml';
    }

    private function getConfig()
    {
        return [
            'atomUrl'     => route('blog.atom.index'),
            'description' => config('taskforce-blog.feeds.description'),
            'title'       => config('taskforce-blog.feeds.title'),
        ];
    }
}

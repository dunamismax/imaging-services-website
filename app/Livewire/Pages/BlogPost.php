<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class BlogPost extends Component
{
    use UsesSiteLayout;

    public string $postSlug;

    /**
     * @var array{title:string,published:string,summary:string,content:array<int,string>}
     */
    public array $post;

    public function mount(string $postSlug): void
    {
        $postMap = config('site_content.blog_posts');
        abort_unless(is_array($postMap) && isset($postMap[$postSlug]), 404);

        $this->postSlug = $postSlug;
        $this->post = $postMap[$postSlug];
    }

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.blog-post', [
                'post' => $this->post,
                'postSlug' => $this->postSlug,
            ]),
            $this->post['title'].' | Imaging Services Media',
            $this->post['summary']
        );
    }
}

<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BlogPostPage extends Component
{
    public string $postSlug = '';

    /**
     * @var array<string,mixed>
     */
    public array $post = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(string $postSlug): void
    {
        $this->postSlug = $postSlug;

        $post = SiteContent::blogPost($postSlug);
        abort_unless(is_array($post), 404);

        $this->post = $post;
        $this->meta = [
            'title' => ($post['title'] ?? 'Media').' | Imaging Services Media',
            'description' => $post['summary'] ?? '',
        ];
    }

    public function render(): View
    {
        return view('livewire.pages.blog-post-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

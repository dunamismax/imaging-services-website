<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Media extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.media', [
                'posts' => config('site_content.blog_posts'),
            ]),
            'Media | Imaging Services',
            'Browse interviews, operational insights, and digital imaging articles from Imaging Services.'
        );
    }
}

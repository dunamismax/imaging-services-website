<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MediaPage extends Component
{
    /**
     * @var array<string,array<string,mixed>>
     */
    public array $posts = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->posts = SiteContent::mediaPosts();
        $this->meta = SiteContent::mediaMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.media-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

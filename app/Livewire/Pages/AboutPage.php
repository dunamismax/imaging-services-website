<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AboutPage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $about = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->about = SiteContent::about();
        $this->meta = SiteContent::aboutMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.about-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

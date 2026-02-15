<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MarketingPage extends Component
{
    public string $pageSlug = '';

    /**
     * @var array<string,mixed>
     */
    public array $page = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(string $pageSlug): void
    {
        $this->pageSlug = $pageSlug;

        $page = SiteContent::marketingPage($pageSlug);
        abort_unless(is_array($page), 404);

        $this->page = $page;
        $this->meta = [
            'title' => ($page['title'] ?? 'Imaging Services').' | Imaging Services',
            'description' => $page['description'] ?? '',
        ];
    }

    public function render(): View
    {
        return view('livewire.pages.marketing-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

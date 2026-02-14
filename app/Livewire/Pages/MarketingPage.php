<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class MarketingPage extends Component
{
    use UsesSiteLayout;

    public string $pageSlug;

    /**
     * @var array{title:string,description:string,body:array<int,string>,cta:array{label:string,route:string}}
     */
    public array $page;

    public function mount(string $pageSlug): void
    {
        $pages = config('site_content.marketing_pages');
        abort_unless(is_array($pages) && isset($pages[$pageSlug]), 404);

        $this->pageSlug = $pageSlug;
        $this->page = $pages[$pageSlug];
    }

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.marketing-page', [
                'page' => $this->page,
                'pageSlug' => $this->pageSlug,
            ]),
            $this->page['title'].' | Imaging Services',
            $this->page['description']
        );
    }
}

<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class HomePage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $home = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->home = SiteContent::home();
        $this->meta = SiteContent::homeMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.home-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ServicesPage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $services = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->services = SiteContent::services();
        $this->meta = SiteContent::servicesMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.services-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

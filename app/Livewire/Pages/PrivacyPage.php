<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PrivacyPage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $privacy = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->privacy = SiteContent::privacy();
        $this->meta = SiteContent::privacyMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.privacy-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

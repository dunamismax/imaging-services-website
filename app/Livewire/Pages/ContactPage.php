<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ContactPage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $contact = [];

    /**
     * @var array<int,string>
     */
    public array $serviceOptions = [];

    /**
     * @var array<int,string>
     */
    public array $trainingOptions = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->contact = SiteContent::contact();
        $this->serviceOptions = SiteContent::serviceOptions();
        $this->trainingOptions = SiteContent::trainingOptions();
        $this->meta = SiteContent::contactMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.contact-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

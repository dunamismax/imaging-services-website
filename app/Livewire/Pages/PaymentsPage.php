<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PaymentsPage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $payments = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->payments = SiteContent::payments();
        $this->meta = SiteContent::paymentsMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.payments-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

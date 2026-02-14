<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Payments extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.payments', [
                'payments' => config('site_content.payments'),
                'company' => config('site_content.company'),
            ]),
            'Payments | Imaging Services',
            'Send checks, deposits, and payment confirmations to Imaging Services with secure support for bank transfer and credit cards.'
        );
    }
}

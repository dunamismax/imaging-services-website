<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Contact extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.contact', [
                'contact' => config('site_content.contact'),
                'company' => config('site_content.company'),
                'hours' => config('site_content.hours'),
            ]),
            'Contact Us | Imaging Services',
            'Contact Imaging Services for equipment sales, accessories, service requests, and training support.'
        );
    }
}

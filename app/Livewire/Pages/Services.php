<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Services extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.services', [
                'services' => config('site_content.services'),
                'partners' => config('site_content.partners'),
            ]),
            'Services and Training | Imaging Services',
            'Request setup, maintenance, repair, remote support, and equipment training from the Imaging Services technical team.'
        );
    }
}

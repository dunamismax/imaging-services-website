<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Home extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.home', [
                'company' => config('site_content.company'),
                'hours' => config('site_content.hours'),
                'home' => config('site_content.home'),
                'partners' => config('site_content.partners'),
            ]),
            'Imaging Services | Digital X-Ray Equipment, Service, and Support',
            'Imaging Services provides digital X-ray equipment, accessories, service, training, and workflow support for clinics nationwide.'
        );
    }
}

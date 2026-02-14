<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Equipment extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.equipment', [
                'equipment' => config('site_content.equipment'),
                'partners' => config('site_content.partners'),
            ]),
            'Equipment | Imaging Services',
            'Explore chiropractic, podiatry, veterinary, mobile, and specialty digital X-ray equipment backed by Imaging Services support.'
        );
    }
}

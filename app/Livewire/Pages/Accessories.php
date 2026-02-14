<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Accessories extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.accessories', [
                'accessories' => config('site_content.accessories'),
                'partners' => config('site_content.partners'),
            ]),
            'Accessories | Imaging Services',
            'Browse imaging accessories catalogs, order workflows, and support details from Imaging Services.'
        );
    }
}

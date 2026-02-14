<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class About extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.about', [
                'about' => config('site_content.about'),
                'partners' => config('site_content.partners'),
            ]),
            'About Us | Imaging Services',
            'Meet the Imaging Services team supporting digital imaging operations, equipment lifecycle planning, and dependable technical service.'
        );
    }
}

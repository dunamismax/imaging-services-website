<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class Privacy extends Component
{
    use UsesSiteLayout;

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.privacy', [
                'privacy' => config('site_content.privacy'),
                'company' => config('site_content.company'),
            ]),
            'Privacy Policy and Terms | Imaging Services',
            'Review Imaging Services privacy policy details and website terms of service.'
        );
    }
}

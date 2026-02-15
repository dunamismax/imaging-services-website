<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AccessoriesPage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $accessories = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->accessories = SiteContent::accessories();
        $this->meta = SiteContent::accessoriesMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.accessories-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EquipmentPage extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $equipment = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(): void
    {
        $this->equipment = SiteContent::equipment();
        $this->meta = SiteContent::equipmentMeta();
    }

    public function render(): View
    {
        return view('livewire.pages.equipment-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

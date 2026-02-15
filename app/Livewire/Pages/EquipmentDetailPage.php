<?php

namespace App\Livewire\Pages;

use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EquipmentDetailPage extends Component
{
    public string $equipmentSlug = '';

    /**
     * @var array<string,mixed>
     */
    public array $equipment = [];

    /**
     * @var array<string,mixed>
     */
    public array $meta = [];

    public function mount(string $equipmentSlug): void
    {
        $this->equipmentSlug = $equipmentSlug;

        $equipment = SiteContent::equipmentDetail($equipmentSlug);
        abort_unless(is_array($equipment), 404);

        $this->equipment = $equipment;
        $this->meta = [
            'title' => ($equipment['title'] ?? 'Equipment').' | Imaging Services',
            'description' => $equipment['subtitle'] ?? '',
        ];
    }

    public function render(): View
    {
        return view('livewire.pages.equipment-detail-page')
            ->layout('layouts.site', ['meta' => $this->meta]);
    }
}

<?php

namespace App\Livewire\Pages;

use App\Livewire\Pages\Concerns\UsesSiteLayout;
use Illuminate\View\View;
use Livewire\Component;

class EquipmentDetail extends Component
{
    use UsesSiteLayout;

    public string $equipmentSlug;

    /**
     * @var array{title:string,subtitle:string,image:string,highlights:array<int,string>,brochure?:string}
     */
    public array $equipment;

    public function mount(string $equipmentSlug): void
    {
        $equipmentMap = config('site_content.equipment_details');
        abort_unless(is_array($equipmentMap) && isset($equipmentMap[$equipmentSlug]), 404);

        $this->equipmentSlug = $equipmentSlug;
        $this->equipment = $equipmentMap[$equipmentSlug];
    }

    public function render(): View
    {
        return $this->withSiteLayout(
            view('livewire.pages.equipment-detail', [
                'equipment' => $this->equipment,
                'equipmentSlug' => $this->equipmentSlug,
            ]),
            $this->equipment['title'].' | Imaging Services',
            $this->equipment['subtitle']
        );
    }
}

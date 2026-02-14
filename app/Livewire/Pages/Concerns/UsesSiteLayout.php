<?php

namespace App\Livewire\Pages\Concerns;

use Illuminate\View\View;

trait UsesSiteLayout
{
    protected function withSiteLayout(View $view, string $title, string $description): View
    {
        return $view->layout('layouts.site', [
            'title' => $title,
            'description' => $description,
        ]);
    }
}

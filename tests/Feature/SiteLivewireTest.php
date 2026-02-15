<?php

it('renders the home route through livewire layout', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('wire:navigate.hover', false)
        ->assertSee('livewire.js', false)
        ->assertSee('Imaging Services | Digital X-Ray Equipment, Service, and Support', false)
        ->assertDontSee('data-page=', false);
});

it('renders dynamic livewire content routes', function () {
    $this->get('/equipment/chiropractic-x-ray')
        ->assertSuccessful()
        ->assertSee('Chiropractic X-Ray')
        ->assertSee('Back to Equipment');

    $this->get('/promo-eq-summer-24')
        ->assertSuccessful()
        ->assertSee('Return Home')
        ->assertSee('Imaging Services');
});

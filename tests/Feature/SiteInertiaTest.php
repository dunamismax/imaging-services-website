<?php

use Inertia\Testing\AssertableInertia as Assert;

it('renders the home route as an inertia page', function () {
    $this->get('/')
        ->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->where('meta.title', 'Imaging Services | Digital X-Ray Equipment, Service, and Support')
            ->has('home.hero')
            ->has('site.company.name')
            ->has('site.navigation', 7)
            ->has('site.forms.contactSales'));
});

it('renders dynamic content routes as inertia pages', function () {
    $this->get('/equipment/chiropractic-x-ray')
        ->assertInertia(fn (Assert $page) => $page
            ->component('EquipmentDetail')
            ->where('equipmentSlug', 'chiropractic-x-ray')
            ->has('equipment.title')
            ->where('equipment.backUrl', route('equipment')));

    $this->get('/promo-eq-summer-24')
        ->assertInertia(fn (Assert $page) => $page
            ->component('MarketingPage')
            ->has('page.ctaUrl')
            ->where('page.homeUrl', route('home')));
});

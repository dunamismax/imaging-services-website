<?php

use App\Livewire\Forms\ContactSalesForm;
use App\Livewire\Forms\ServiceRequestForm;
use App\Livewire\Forms\TrainingRequestForm;
use Livewire\Livewire;

it('validates contact sales form required fields', function () {
    Livewire::test(ContactSalesForm::class)
        ->call('submit')
        ->assertHasErrors(['name', 'phone', 'email']);
});

it('submits contact sales form', function () {
    Livewire::test(ContactSalesForm::class)
        ->set('name', 'Jordan Smith')
        ->set('phone', '(555) 555-1234')
        ->set('email', 'jordan@example.com')
        ->set('company', 'Springfield Clinic')
        ->set('notes', 'Need options for a digital upgrade this quarter.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true);
});

it('requires at least one service request option', function () {
    Livewire::test(ServiceRequestForm::class)
        ->set('name', 'Taylor Lee')
        ->set('phone', '(555) 222-0000')
        ->set('email', 'taylor@example.com')
        ->set('company', 'Summit Imaging')
        ->call('submit')
        ->assertHasErrors(['serviceOptions']);
});

it('submits service request form', function () {
    $options = config('site_content.services.service_options');

    Livewire::test(ServiceRequestForm::class)
        ->set('name', 'Taylor Lee')
        ->set('phone', '(555) 222-0000')
        ->set('email', 'taylor@example.com')
        ->set('company', 'Summit Imaging')
        ->set('serviceOptions', [$options[0]])
        ->set('notes', 'Need maintenance planning and remote support.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true);
});

it('submits training request form', function () {
    $options = config('site_content.services.training_options');

    Livewire::test(TrainingRequestForm::class)
        ->set('name', 'Avery Morgan')
        ->set('phone', '(555) 100-9898')
        ->set('email', 'avery@example.com')
        ->set('company', 'Northside Ortho')
        ->set('trainingOptions', [$options[0], $options[1]])
        ->set('notes', 'Please include software workflow training.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true);
});

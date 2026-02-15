<?php

use App\Livewire\Forms\ContactSalesForm;
use App\Livewire\Forms\SelectableRequestForm;
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
        ->assertSet('submitted', true)
        ->assertSet('name', '')
        ->assertSet('phone', '')
        ->assertSet('email', '')
        ->assertSet('company', '')
        ->assertSet('notes', '');
});

it('requires at least one service request option', function () {
    /** @var array<int,string> $options */
    $options = config('site_content.services.service_options', []);

    Livewire::test(SelectableRequestForm::class, [
        'options' => $options,
        'formKey' => 'service-request',
    ])
        ->set('name', 'Taylor Lee')
        ->set('phone', '(555) 222-0000')
        ->set('email', 'taylor@example.com')
        ->set('company', 'Summit Imaging')
        ->call('submit')
        ->assertHasErrors(['selectedOptions']);
});

it('submits service request form', function () {
    /** @var array<int,string> $options */
    $options = config('site_content.services.service_options', []);

    expect($options)->not->toBeEmpty();

    Livewire::test(SelectableRequestForm::class, [
        'options' => $options,
        'formKey' => 'service-request',
    ])
        ->set('name', 'Taylor Lee')
        ->set('phone', '(555) 222-0000')
        ->set('email', 'taylor@example.com')
        ->set('company', 'Summit Imaging')
        ->set('selectedOptions', [$options[0]])
        ->set('notes', 'Need maintenance planning and remote support.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true)
        ->assertSet('selectedOptions', []);
});

it('submits training request form', function () {
    /** @var array<int,string> $options */
    $options = config('site_content.services.training_options', []);

    expect(count($options))->toBeGreaterThanOrEqual(2);

    Livewire::test(SelectableRequestForm::class, [
        'options' => $options,
        'formKey' => 'training-request',
    ])
        ->set('name', 'Avery Morgan')
        ->set('phone', '(555) 100-9898')
        ->set('email', 'avery@example.com')
        ->set('company', 'Northside Ortho')
        ->set('selectedOptions', [$options[0], $options[1]])
        ->set('notes', 'Please include software workflow training.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true)
        ->assertSet('selectedOptions', []);
});

it('rate limits rapid repeat form submissions', function () {
    $payload = fn () => Livewire::test(ContactSalesForm::class)
        ->set('name', 'Jordan Smith')
        ->set('phone', '(555) 555-1234')
        ->set('email', 'jordan@example.com')
        ->set('company', 'Springfield Clinic')
        ->set('notes', 'Need options for a digital upgrade this quarter.');

    foreach (range(1, 5) as $_) {
        $payload()
            ->call('submit')
            ->assertHasNoErrors('form')
            ->assertSet('submitted', true);
    }

    $payload()
        ->call('submit')
        ->assertHasErrors('form')
        ->assertSee('Please wait');
});

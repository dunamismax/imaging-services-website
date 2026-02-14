<?php

it('validates contact sales form required fields', function () {
    $this->postJson(route('forms.contact-sales'), [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'phone', 'email']);
});

it('submits contact sales form', function () {
    $this->postJson(route('forms.contact-sales'), [
        'name' => 'Jordan Smith',
        'phone' => '(555) 555-1234',
        'email' => 'jordan@example.com',
        'company' => 'Springfield Clinic',
        'notes' => 'Need options for a digital upgrade this quarter.',
    ])
        ->assertOk()
        ->assertJsonPath('message', 'We received your message and a member of our sales team will reach out within one business day.');
});

it('requires at least one service request option', function () {
    $this->postJson(route('forms.service-request'), [
        'name' => 'Taylor Lee',
        'phone' => '(555) 222-0000',
        'email' => 'taylor@example.com',
        'company' => 'Summit Imaging',
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['serviceOptions']);
});

it('submits service request form', function () {
    $options = config('site_content.services.service_options');

    $this->postJson(route('forms.service-request'), [
        'name' => 'Taylor Lee',
        'phone' => '(555) 222-0000',
        'email' => 'taylor@example.com',
        'company' => 'Summit Imaging',
        'serviceOptions' => [$options[0]],
        'notes' => 'Need maintenance planning and remote support.',
    ])
        ->assertOk()
        ->assertJsonPath('message', 'We received your message and a member of our services team will reach out within one business day.');
});

it('submits training request form', function () {
    $options = config('site_content.services.training_options');

    $this->postJson(route('forms.training-request'), [
        'name' => 'Avery Morgan',
        'phone' => '(555) 100-9898',
        'email' => 'avery@example.com',
        'company' => 'Northside Ortho',
        'trainingOptions' => [$options[0], $options[1]],
        'notes' => 'Please include software workflow training.',
    ])
        ->assertOk()
        ->assertJsonPath('message', 'We received your message and a member of our training team will reach out within one business day.');
});

it('rate limits rapid repeat form submissions', function () {
    $payload = [
        'name' => 'Jordan Smith',
        'phone' => '(555) 555-1234',
        'email' => 'jordan@example.com',
        'company' => 'Springfield Clinic',
        'notes' => 'Need options for a digital upgrade this quarter.',
    ];

    foreach (range(1, 5) as $_) {
        $this->postJson(route('forms.contact-sales'), $payload)->assertOk();
    }

    $response = $this->postJson(route('forms.contact-sales'), $payload)
        ->assertStatus(429)
        ->assertJsonValidationErrors(['form']);

    expect($response->json('errors.form.0'))->toContain('Please wait');
});

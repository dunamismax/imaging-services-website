<?php

namespace App\Livewire\Forms;

use App\Livewire\Forms\Concerns\ThrottlesSubmissions;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class ContactSalesForm extends Component
{
    use ThrottlesSubmissions;

    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $company = '';

    public string $notes = '';

    public bool $submitted = false;

    public function submit(): void
    {
        if ($this->isRateLimited('contact-sales')) {
            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'phone' => ['required', 'string', 'min:10', 'max:18'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'min:2', 'max:60'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'phone.min' => 'Please enter a valid phone number.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        Log::info('Contact sales inquiry submitted', [
            'form' => 'contact_sales',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] ?: null,
        ]);

        $this->reset(['name', 'phone', 'email', 'company', 'notes']);
        $this->resetValidation();
        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.forms.contact-sales-form', [
            'successMessage' => 'We received your message and a member of our sales team will reach out within one business day.',
        ]);
    }
}

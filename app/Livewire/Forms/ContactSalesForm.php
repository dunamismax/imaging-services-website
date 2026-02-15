<?php

namespace App\Livewire\Forms;

use App\Livewire\Forms\Concerns\GuardsSiteFormRateLimit;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ContactSalesForm extends Component
{
    use GuardsSiteFormRateLimit;

    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $company = '';

    public string $notes = '';

    public bool $submitted = false;

    public string $successMessage = 'We received your message and a member of our sales team will reach out within one business day.';

    public function submit(): void
    {
        $this->submitted = false;
        $this->resetValidation();

        if (! $this->guardRateLimit('contact-sales')) {
            return;
        }

        $validated = $this->validate();

        Log::info('Contact sales inquiry submitted', [
            'form' => 'contact_sales',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] ?: null,
        ]);

        $this->reset(['name', 'phone', 'email', 'company', 'notes']);
        $this->submitted = true;
    }

    /**
     * @return array<string,array<int,string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'phone' => ['required', 'string', 'min:10', 'max:18'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'min:2', 'max:60'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string,string>
     */
    protected function messages(): array
    {
        return [
            'phone.min' => 'Please enter a valid phone number.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }

    public function render(): View
    {
        return view('livewire.forms.contact-sales-form');
    }
}

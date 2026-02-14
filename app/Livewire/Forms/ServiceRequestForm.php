<?php

namespace App\Livewire\Forms;

use App\Livewire\Forms\Concerns\ThrottlesSubmissions;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

class ServiceRequestForm extends Component
{
    use ThrottlesSubmissions;

    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $company = '';

    /**
     * @var array<int,string>
     */
    public array $serviceOptions = [];

    public string $notes = '';

    public bool $submitted = false;

    /**
     * @return array<int,string>
     */
    private function availableOptions(): array
    {
        $options = config('site_content.services.service_options');

        return is_array($options) ? $options : [];
    }

    public function submit(): void
    {
        if ($this->isRateLimited('service-request')) {
            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'phone' => ['required', 'string', 'min:10', 'max:18'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['required', 'string', 'min:2', 'max:60'],
            'serviceOptions' => ['required', 'array', 'min:1'],
            'serviceOptions.*' => ['string', Rule::in($this->availableOptions())],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'serviceOptions.required' => 'Select at least one service option.',
            'serviceOptions.min' => 'Select at least one service option.',
        ]);

        Log::info('Service request submitted', [
            'form' => 'service_request',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'],
            'options' => $validated['serviceOptions'],
        ]);

        $this->reset(['name', 'phone', 'email', 'company', 'serviceOptions', 'notes']);
        $this->resetValidation();
        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.forms.service-request-form', [
            'options' => $this->availableOptions(),
            'successMessage' => 'We received your message and a member of our services team will reach out within one business day.',
        ]);
    }
}

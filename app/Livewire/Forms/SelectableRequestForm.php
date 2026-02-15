<?php

namespace App\Livewire\Forms;

use App\Livewire\Forms\Concerns\GuardsSiteFormRateLimit;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SelectableRequestForm extends Component
{
    use GuardsSiteFormRateLimit;

    /**
     * @var array<int,string>
     */
    public array $options = [];

    public string $formKey = 'service-request';

    public string $optionsLegend = 'Select one or more options';

    public string $buttonLabel = 'Submit Request';

    public string $pillLabel = 'Request';

    public string $headingLabel = 'Send your request';

    public string $successMessage = 'Your request has been submitted.';

    public bool $requireCompany = true;

    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $company = '';

    public string $notes = '';

    /**
     * @var array<int,string>
     */
    public array $selectedOptions = [];

    public bool $submitted = false;

    /**
     * @param  array<int,string>  $options
     */
    public function mount(
        array $options = [],
        string $formKey = 'service-request',
        string $optionsLegend = 'Select one or more options',
        string $buttonLabel = 'Submit Request',
        string $pillLabel = 'Request',
        string $headingLabel = 'Send your request',
        string $successMessage = 'Your request has been submitted.',
        bool $requireCompany = true,
    ): void {
        $this->options = $options;
        $this->formKey = $formKey;
        $this->optionsLegend = $optionsLegend;
        $this->buttonLabel = $buttonLabel;
        $this->pillLabel = $pillLabel;
        $this->headingLabel = $headingLabel;
        $this->successMessage = $successMessage;
        $this->requireCompany = $requireCompany;
    }

    public function submit(): void
    {
        $this->submitted = false;
        $this->resetValidation();

        if (! $this->guardRateLimit($this->formKey)) {
            return;
        }

        $validated = $this->validate();

        $logMessage = $this->formKey === 'training-request'
            ? 'Training request submitted'
            : 'Service request submitted';

        Log::info($logMessage, [
            'form' => str_replace('-', '_', $this->formKey),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'],
            'options' => $validated['selectedOptions'],
        ]);

        $this->reset(['name', 'phone', 'email', 'company', 'notes', 'selectedOptions']);
        $this->submitted = true;
    }

    /**
     * @return array<string,array<int,mixed>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'phone' => ['required', 'string', 'min:10', 'max:18'],
            'email' => ['required', 'email', 'max:255'],
            'company' => $this->requireCompany
                ? ['required', 'string', 'min:2', 'max:60']
                : ['nullable', 'string', 'min:2', 'max:60'],
            'selectedOptions' => ['required', 'array', 'min:1'],
            'selectedOptions.*' => ['string', Rule::in($this->options)],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string,string>
     */
    protected function messages(): array
    {
        return [
            'selectedOptions.required' => 'Select at least one option.',
            'selectedOptions.min' => 'Select at least one option.',
        ];
    }

    public function render(): View
    {
        return view('livewire.forms.selectable-request-form');
    }
}

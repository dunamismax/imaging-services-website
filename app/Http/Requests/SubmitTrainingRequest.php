<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ThrottlesSiteFormRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitTrainingRequest extends FormRequest
{
    use ThrottlesSiteFormRequests;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->guardRateLimit('training-request');
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'phone' => ['required', 'string', 'min:10', 'max:18'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['required', 'string', 'min:2', 'max:60'],
            'trainingOptions' => ['required', 'array', 'min:1'],
            'trainingOptions.*' => ['string', Rule::in($this->availableOptions())],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'trainingOptions.required' => 'Select at least one training option.',
            'trainingOptions.min' => 'Select at least one training option.',
        ];
    }

    /**
     * @return array<int,string>
     */
    private function availableOptions(): array
    {
        $options = config('site_content.services.training_options');

        return is_array($options) ? $options : [];
    }
}

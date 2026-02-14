<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ThrottlesSiteFormRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitServiceRequest extends FormRequest
{
    use ThrottlesSiteFormRequests;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->guardRateLimit('service-request');
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
            'serviceOptions' => ['required', 'array', 'min:1'],
            'serviceOptions.*' => ['string', Rule::in($this->availableOptions())],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'serviceOptions.required' => 'Select at least one service option.',
            'serviceOptions.min' => 'Select at least one service option.',
        ];
    }

    /**
     * @return array<int,string>
     */
    private function availableOptions(): array
    {
        $options = config('site_content.services.service_options');

        return is_array($options) ? $options : [];
    }
}

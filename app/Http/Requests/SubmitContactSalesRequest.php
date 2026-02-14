<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ThrottlesSiteFormRequests;
use Illuminate\Foundation\Http\FormRequest;

class SubmitContactSalesRequest extends FormRequest
{
    use ThrottlesSiteFormRequests;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->guardRateLimit('contact-sales');
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
            'company' => ['nullable', 'string', 'min:2', 'max:60'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'phone.min' => 'Please enter a valid phone number.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }
}

<?php

namespace App\Livewire\Forms\Concerns;

use Illuminate\Support\Facades\RateLimiter;

trait GuardsSiteFormRateLimit
{
    protected function guardRateLimit(string $formKey, int $maxAttempts = 5, int $decaySeconds = 120): bool
    {
        $throttleKey = sprintf('site-form:%s:%s', $formKey, request()->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $message = "Please wait {$seconds} seconds before submitting again.";

            $this->addError('form', $message);

            return false;
        }

        RateLimiter::hit($throttleKey, $decaySeconds);

        return true;
    }
}

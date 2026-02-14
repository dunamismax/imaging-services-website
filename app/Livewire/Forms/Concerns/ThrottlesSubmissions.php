<?php

namespace App\Livewire\Forms\Concerns;

use Illuminate\Support\Facades\RateLimiter;

trait ThrottlesSubmissions
{
    protected function isRateLimited(string $formKey, int $maxAttempts = 5, int $decaySeconds = 120): bool
    {
        $throttleKey = sprintf('site-form:%s:%s', $formKey, request()->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('form', "Please wait {$seconds} seconds before submitting again.");

            return true;
        }

        RateLimiter::hit($throttleKey, $decaySeconds);

        return false;
    }
}

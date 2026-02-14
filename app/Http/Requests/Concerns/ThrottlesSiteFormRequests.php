<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\RateLimiter;

trait ThrottlesSiteFormRequests
{
    protected function guardRateLimit(string $formKey, int $maxAttempts = 5, int $decaySeconds = 120): void
    {
        $throttleKey = sprintf('site-form:%s:%s', $formKey, $this->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $message = "Please wait {$seconds} seconds before submitting again.";

            throw new HttpResponseException(response()->json([
                'message' => $message,
                'errors' => [
                    'form' => [$message],
                ],
            ], 429));
        }

        RateLimiter::hit($throttleKey, $decaySeconds);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitContactSalesRequest;
use App\Http\Requests\SubmitServiceRequest;
use App\Http\Requests\SubmitTrainingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FormSubmissionController extends Controller
{
    public function contactSales(SubmitContactSalesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Log::info('Contact sales inquiry submitted', [
            'form' => 'contact_sales',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] ?: null,
        ]);

        return response()->json([
            'message' => 'We received your message and a member of our sales team will reach out within one business day.',
        ]);
    }

    public function serviceRequest(SubmitServiceRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Log::info('Service request submitted', [
            'form' => 'service_request',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'],
            'options' => $validated['serviceOptions'],
        ]);

        return response()->json([
            'message' => 'We received your message and a member of our services team will reach out within one business day.',
        ]);
    }

    public function trainingRequest(SubmitTrainingRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Log::info('Training request submitted', [
            'form' => 'training_request',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'],
            'options' => $validated['trainingOptions'],
        ]);

        return response()->json([
            'message' => 'We received your message and a member of our training team will reach out within one business day.',
        ]);
    }
}

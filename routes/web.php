<?php

use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\SitePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitePageController::class, 'home'])->name('home');
Route::get('/about-us', [SitePageController::class, 'about'])->name('about');
Route::get('/equipment', [SitePageController::class, 'equipment'])->name('equipment');
Route::get('/services', [SitePageController::class, 'services'])->name('services');
Route::get('/accessories', [SitePageController::class, 'accessories'])->name('accessories');
Route::get('/contact-us', [SitePageController::class, 'contact'])->name('contact');
Route::get('/contact', [SitePageController::class, 'contact'])->name('contact.alias');
Route::get('/payments', [SitePageController::class, 'payments'])->name('payments');
Route::get('/privacy-policy-terms-of-use', [SitePageController::class, 'privacy'])->name('privacy');
Route::get('/privacy-policy-terms', [SitePageController::class, 'privacy'])->name('privacy.legacy');
Route::get('/media', [SitePageController::class, 'media'])->name('media');

Route::prefix('forms')->name('forms.')->group(function (): void {
    Route::post('/contact-sales', [FormSubmissionController::class, 'contactSales'])->name('contact-sales');
    Route::post('/service-request', [FormSubmissionController::class, 'serviceRequest'])->name('service-request');
    Route::post('/training-request', [FormSubmissionController::class, 'trainingRequest'])->name('training-request');
});

/** @var array<string,mixed> $equipment */
$equipment = config('site_content.equipment_details');
/** @var array<string,mixed> $posts */
$posts = config('site_content.blog_posts');
/** @var array<string,mixed> $marketingPages */
$marketingPages = config('site_content.marketing_pages');

Route::get('/equipment/{equipmentSlug}', [SitePageController::class, 'equipmentDetail'])
    ->whereIn('equipmentSlug', array_keys(is_array($equipment) ? $equipment : []))
    ->name('equipment.detail');

Route::get('/{postSlug}', [SitePageController::class, 'blogPost'])
    ->whereIn('postSlug', array_keys(is_array($posts) ? $posts : []))
    ->name('blog.post');

Route::get('/{pageSlug}', [SitePageController::class, 'marketingPage'])
    ->whereIn('pageSlug', array_keys(is_array($marketingPages) ? $marketingPages : []))
    ->name('marketing.page');

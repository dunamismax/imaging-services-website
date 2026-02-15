<?php

use App\Livewire\Pages\AboutPage;
use App\Livewire\Pages\AccessoriesPage;
use App\Livewire\Pages\BlogPostPage;
use App\Livewire\Pages\ContactPage;
use App\Livewire\Pages\EquipmentDetailPage;
use App\Livewire\Pages\EquipmentPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\MarketingPage;
use App\Livewire\Pages\MediaPage;
use App\Livewire\Pages\PaymentsPage;
use App\Livewire\Pages\PrivacyPage;
use App\Livewire\Pages\ServicesPage;
use Illuminate\Support\Facades\Route;

Route::livewire('/', HomePage::class)->name('home');
Route::livewire('/about-us', AboutPage::class)->name('about');
Route::livewire('/equipment', EquipmentPage::class)->name('equipment');
Route::livewire('/services', ServicesPage::class)->name('services');
Route::livewire('/accessories', AccessoriesPage::class)->name('accessories');
Route::livewire('/contact-us', ContactPage::class)->name('contact');
Route::livewire('/contact', ContactPage::class)->name('contact.alias');
Route::livewire('/payments', PaymentsPage::class)->name('payments');
Route::livewire('/privacy-policy-terms-of-use', PrivacyPage::class)->name('privacy');
Route::livewire('/privacy-policy-terms', PrivacyPage::class)->name('privacy.legacy');
Route::livewire('/media', MediaPage::class)->name('media');

/** @var array<string,mixed> $equipment */
$equipment = config('site_content.equipment_details');
/** @var array<string,mixed> $posts */
$posts = config('site_content.blog_posts');
/** @var array<string,mixed> $marketingPages */
$marketingPages = config('site_content.marketing_pages');

Route::livewire('/equipment/{equipmentSlug}', EquipmentDetailPage::class)
    ->whereIn('equipmentSlug', array_keys(is_array($equipment) ? $equipment : []))
    ->name('equipment.detail');

Route::livewire('/{postSlug}', BlogPostPage::class)
    ->whereIn('postSlug', array_keys(is_array($posts) ? $posts : []))
    ->name('blog.post');

Route::livewire('/{pageSlug}', MarketingPage::class)
    ->whereIn('pageSlug', array_keys(is_array($marketingPages) ? $marketingPages : []))
    ->name('marketing.page');

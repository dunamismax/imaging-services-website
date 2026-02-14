<?php

use App\Livewire\Pages\About;
use App\Livewire\Pages\Accessories;
use App\Livewire\Pages\BlogPost;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Equipment;
use App\Livewire\Pages\EquipmentDetail;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\MarketingPage;
use App\Livewire\Pages\Media;
use App\Livewire\Pages\Payments;
use App\Livewire\Pages\Privacy;
use App\Livewire\Pages\Services;
use Illuminate\Support\Facades\Route;

Route::livewire('/', Home::class)->name('home');
Route::livewire('/about-us', About::class)->name('about');
Route::livewire('/equipment', Equipment::class)->name('equipment');
Route::livewire('/services', Services::class)->name('services');
Route::livewire('/accessories', Accessories::class)->name('accessories');
Route::livewire('/contact-us', Contact::class)->name('contact');
Route::livewire('/contact', Contact::class)->name('contact.alias');
Route::livewire('/payments', Payments::class)->name('payments');
Route::livewire('/privacy-policy-terms-of-use', Privacy::class)->name('privacy');
Route::livewire('/privacy-policy-terms', Privacy::class)->name('privacy.legacy');
Route::livewire('/media', Media::class)->name('media');

/** @var array<string,mixed> $equipment */
$equipment = config('site_content.equipment_details');
/** @var array<string,mixed> $posts */
$posts = config('site_content.blog_posts');
/** @var array<string,mixed> $marketingPages */
$marketingPages = config('site_content.marketing_pages');

Route::livewire('/equipment/{equipmentSlug}', EquipmentDetail::class)
    ->whereIn('equipmentSlug', array_keys($equipment))
    ->name('equipment.detail');

Route::livewire('/{postSlug}', BlogPost::class)
    ->whereIn('postSlug', array_keys($posts))
    ->name('blog.post');

Route::livewire('/{pageSlug}', MarketingPage::class)
    ->whereIn('pageSlug', array_keys($marketingPages))
    ->name('marketing.page');

<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $company = config('site_content.company');
        $tollFreePhone = is_array($company) && isset($company['phone_toll_free']) && is_string($company['phone_toll_free'])
            ? $company['phone_toll_free']
            : '';
        $dialPhone = preg_replace('/[^\d+]/', '', $tollFreePhone);

        return [
            ...parent::share($request),
            'site' => [
                'company' => config('site_content.company'),
                'hours' => config('site_content.hours'),
                'partners' => config('site_content.partners'),
                'navigation' => [
                    ['label' => 'Home', 'url' => route('home'), 'routeName' => 'home'],
                    ['label' => 'Equipment', 'url' => route('equipment'), 'routeName' => 'equipment'],
                    ['label' => 'Services', 'url' => route('services'), 'routeName' => 'services'],
                    ['label' => 'Accessories', 'url' => route('accessories'), 'routeName' => 'accessories'],
                    ['label' => 'About', 'url' => route('about'), 'routeName' => 'about'],
                    ['label' => 'Media', 'url' => route('media'), 'routeName' => 'media'],
                    ['label' => 'Contact', 'url' => route('contact'), 'routeName' => 'contact'],
                ],
                'quickLinks' => [
                    ['label' => 'Privacy & Terms', 'url' => route('privacy')],
                    ['label' => 'Refunds', 'url' => route('marketing.page', ['pageSlug' => 'refund_returns'])],
                    ['label' => 'Careers', 'url' => route('marketing.page', ['pageSlug' => 'careers'])],
                ],
                'urls' => [
                    'home' => route('home'),
                    'equipment' => route('equipment'),
                    'services' => route('services'),
                    'media' => route('media'),
                    'payments' => route('payments'),
                    'contact' => route('contact'),
                    'tollFreePhone' => $tollFreePhone,
                    'tollFreeDial' => is_string($dialPhone) ? 'tel:'.$dialPhone : '',
                ],
                'forms' => [
                    'contactSales' => route('forms.contact-sales'),
                    'serviceRequest' => route('forms.service-request'),
                    'trainingRequest' => route('forms.training-request'),
                ],
            ],
            'routing' => [
                'currentRoute' => $request->route()?->getName(),
            ],
        ];
    }
}

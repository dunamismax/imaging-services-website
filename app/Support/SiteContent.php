<?php

namespace App\Support;

class SiteContent
{
    /**
     * @return array<string,mixed>
     */
    public static function site(): array
    {
        $company = config('site_content.company');
        $tollFreePhone = is_array($company) && isset($company['phone_toll_free']) && is_string($company['phone_toll_free'])
            ? $company['phone_toll_free']
            : '';
        $dialPhone = preg_replace('/[^\d+]/', '', $tollFreePhone);

        return [
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
                'privacy' => route('privacy'),
                'tollFreePhone' => $tollFreePhone,
                'tollFreeDial' => is_string($dialPhone) ? 'tel:'.$dialPhone : '',
            ],
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function home(): array
    {
        $home = config('site_content.home');

        if (! is_array($home)) {
            return [];
        }

        if (isset($home['categories']) && is_array($home['categories'])) {
            $home['categories'] = self::appendEquipmentDetailUrls($home['categories']);
        }

        if (
            isset($home['hero'])
            && is_array($home['hero'])
            && isset($home['hero']['primary_cta'], $home['hero']['secondary_cta'])
            && is_array($home['hero']['primary_cta'])
            && is_array($home['hero']['secondary_cta'])
        ) {
            $home['hero']['primary_cta'] = self::appendRouteUrl($home['hero']['primary_cta']);
            $home['hero']['secondary_cta'] = self::appendRouteUrl($home['hero']['secondary_cta']);
        }

        return $home;
    }

    /**
     * @return array<string,mixed>
     */
    public static function about(): array
    {
        $about = config('site_content.about');

        return is_array($about) ? $about : [];
    }

    /**
     * @return array<string,mixed>
     */
    public static function equipment(): array
    {
        $equipment = config('site_content.equipment');

        if (! is_array($equipment)) {
            return [];
        }

        if (isset($equipment['categories']) && is_array($equipment['categories'])) {
            $equipment['categories'] = self::appendEquipmentDetailUrls($equipment['categories']);
        }

        return $equipment;
    }

    /**
     * @return array<string,mixed>
     */
    public static function services(): array
    {
        $services = config('site_content.services');

        return is_array($services) ? $services : [];
    }

    /**
     * @return array<string,mixed>
     */
    public static function accessories(): array
    {
        $accessories = config('site_content.accessories');

        return is_array($accessories) ? $accessories : [];
    }

    /**
     * @return array<string,mixed>
     */
    public static function contact(): array
    {
        $contact = config('site_content.contact');

        return is_array($contact) ? $contact : [];
    }

    /**
     * @return array<int,string>
     */
    public static function serviceOptions(): array
    {
        $options = config('site_content.services.service_options');

        return is_array($options) ? $options : [];
    }

    /**
     * @return array<int,string>
     */
    public static function trainingOptions(): array
    {
        $options = config('site_content.services.training_options');

        return is_array($options) ? $options : [];
    }

    /**
     * @return array<string,mixed>
     */
    public static function payments(): array
    {
        $payments = config('site_content.payments');

        return is_array($payments) ? $payments : [];
    }

    /**
     * @return array<string,mixed>
     */
    public static function privacy(): array
    {
        $privacy = config('site_content.privacy');

        return is_array($privacy) ? $privacy : [];
    }

    /**
     * @return array<string,array<string,mixed>>
     */
    public static function mediaPosts(): array
    {
        $posts = config('site_content.blog_posts');

        if (! is_array($posts)) {
            return [];
        }

        return self::appendBlogPostUrls($posts);
    }

    /**
     * @return array<string,mixed>|null
     */
    public static function equipmentDetail(string $equipmentSlug): ?array
    {
        $equipmentMap = config('site_content.equipment_details');

        if (! is_array($equipmentMap) || ! isset($equipmentMap[$equipmentSlug]) || ! is_array($equipmentMap[$equipmentSlug])) {
            return null;
        }

        return [
            ...$equipmentMap[$equipmentSlug],
            'backUrl' => route('equipment'),
        ];
    }

    /**
     * @return array<string,mixed>|null
     */
    public static function blogPost(string $postSlug): ?array
    {
        $postMap = config('site_content.blog_posts');

        if (! is_array($postMap) || ! isset($postMap[$postSlug]) || ! is_array($postMap[$postSlug])) {
            return null;
        }

        return [
            ...$postMap[$postSlug],
            'backUrl' => route('media'),
        ];
    }

    /**
     * @return array<string,mixed>|null
     */
    public static function marketingPage(string $pageSlug): ?array
    {
        $pages = config('site_content.marketing_pages');

        if (! is_array($pages) || ! isset($pages[$pageSlug]) || ! is_array($pages[$pageSlug])) {
            return null;
        }

        $page = $pages[$pageSlug];
        $cta = $page['cta'] ?? null;
        $ctaUrl = '#';

        if (is_array($cta) && isset($cta['route']) && is_string($cta['route'])) {
            $ctaUrl = route($cta['route']);
        }

        return [
            ...$page,
            'ctaUrl' => $ctaUrl,
            'homeUrl' => route('home'),
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function homeMeta(): array
    {
        return [
            'title' => 'Imaging Services | Digital X-Ray Equipment, Service, and Support',
            'description' => 'Imaging Services provides digital X-ray equipment, accessories, service, training, and workflow support for clinics nationwide.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function aboutMeta(): array
    {
        return [
            'title' => 'About Us | Imaging Services',
            'description' => 'Meet the Imaging Services team supporting digital imaging operations, equipment lifecycle planning, and dependable technical service.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function equipmentMeta(): array
    {
        return [
            'title' => 'Equipment | Imaging Services',
            'description' => 'Explore chiropractic, podiatry, veterinary, mobile, and specialty digital X-ray equipment backed by Imaging Services support.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function servicesMeta(): array
    {
        return [
            'title' => 'Services and Training | Imaging Services',
            'description' => 'Request setup, maintenance, repair, remote support, and equipment training from the Imaging Services technical team.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function accessoriesMeta(): array
    {
        return [
            'title' => 'Accessories | Imaging Services',
            'description' => 'Browse imaging accessories catalogs, order workflows, and support details from Imaging Services.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function contactMeta(): array
    {
        return [
            'title' => 'Contact Us | Imaging Services',
            'description' => 'Contact Imaging Services for equipment sales, accessories, service requests, and training support.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function paymentsMeta(): array
    {
        return [
            'title' => 'Payments | Imaging Services',
            'description' => 'Send checks, deposits, and payment confirmations to Imaging Services with secure support for bank transfer and credit cards.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function privacyMeta(): array
    {
        return [
            'title' => 'Privacy Policy and Terms | Imaging Services',
            'description' => 'Review Imaging Services privacy policy details and website terms of service.',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public static function mediaMeta(): array
    {
        return [
            'title' => 'Digital Imaging | Latest News and Insights from Imaging Services USA',
            'description' => 'Browse interviews, operational insights, and digital imaging articles from Imaging Services.',
        ];
    }

    /**
     * @param  array<int,array<string,mixed>>  $items
     * @return array<int,array<string,mixed>>
     */
    private static function appendEquipmentDetailUrls(array $items): array
    {
        return array_map(function (array $item): array {
            $slug = $item['slug'] ?? null;

            if (! is_string($slug)) {
                return $item;
            }

            return [
                ...$item,
                'url' => route('equipment.detail', ['equipmentSlug' => $slug]),
            ];
        }, $items);
    }

    /**
     * @param  array<string,array<string,mixed>>  $posts
     * @return array<string,array<string,mixed>>
     */
    private static function appendBlogPostUrls(array $posts): array
    {
        $mappedPosts = [];

        foreach ($posts as $slug => $post) {
            $mappedPosts[$slug] = [
                ...$post,
                'url' => route('blog.post', ['postSlug' => $slug]),
            ];
        }

        return $mappedPosts;
    }

    /**
     * @param  array<string,mixed>  $cta
     * @return array<string,mixed>
     */
    private static function appendRouteUrl(array $cta): array
    {
        $routeName = $cta['route'] ?? null;

        if (! is_string($routeName)) {
            return $cta;
        }

        return [
            ...$cta,
            'url' => route($routeName),
        ];
    }
}

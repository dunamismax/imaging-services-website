<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SitePageController extends Controller
{
    public function home(): Response
    {
        $home = config('site_content.home');

        if (is_array($home)) {
            if (isset($home['categories']) && is_array($home['categories'])) {
                $home['categories'] = $this->appendEquipmentDetailUrls($home['categories']);
            }

            if (
                isset($home['hero'])
                && is_array($home['hero'])
                && isset($home['hero']['primary_cta'], $home['hero']['secondary_cta'])
                && is_array($home['hero']['primary_cta'])
                && is_array($home['hero']['secondary_cta'])
            ) {
                $home['hero']['primary_cta'] = $this->appendRouteUrl($home['hero']['primary_cta']);
                $home['hero']['secondary_cta'] = $this->appendRouteUrl($home['hero']['secondary_cta']);
            }
        }

        return $this->renderPage(
            'Home',
            [
                'home' => $home,
            ],
            'Imaging Services | Digital X-Ray Equipment, Service, and Support',
            'Imaging Services provides digital X-ray equipment, accessories, service, training, and workflow support for clinics nationwide.'
        );
    }

    public function about(): Response
    {
        return $this->renderPage(
            'About',
            [
                'about' => config('site_content.about'),
            ],
            'About Us | Imaging Services',
            'Meet the Imaging Services team supporting digital imaging operations, equipment lifecycle planning, and dependable technical service.'
        );
    }

    public function equipment(): Response
    {
        $equipment = config('site_content.equipment');

        if (is_array($equipment) && isset($equipment['categories']) && is_array($equipment['categories'])) {
            $equipment['categories'] = $this->appendEquipmentDetailUrls($equipment['categories']);
        }

        return $this->renderPage(
            'Equipment',
            [
                'equipment' => $equipment,
            ],
            'Equipment | Imaging Services',
            'Explore chiropractic, podiatry, veterinary, mobile, and specialty digital X-ray equipment backed by Imaging Services support.'
        );
    }

    public function services(): Response
    {
        return $this->renderPage(
            'Services',
            [
                'services' => config('site_content.services'),
            ],
            'Services and Training | Imaging Services',
            'Request setup, maintenance, repair, remote support, and equipment training from the Imaging Services technical team.'
        );
    }

    public function accessories(): Response
    {
        return $this->renderPage(
            'Accessories',
            [
                'accessories' => config('site_content.accessories'),
            ],
            'Accessories | Imaging Services',
            'Browse imaging accessories catalogs, order workflows, and support details from Imaging Services.'
        );
    }

    public function contact(): Response
    {
        $services = config('site_content.services');

        return $this->renderPage(
            'Contact',
            [
                'contact' => config('site_content.contact'),
                'serviceOptions' => is_array($services) ? ($services['service_options'] ?? []) : [],
                'trainingOptions' => is_array($services) ? ($services['training_options'] ?? []) : [],
            ],
            'Contact Us | Imaging Services',
            'Contact Imaging Services for equipment sales, accessories, service requests, and training support.'
        );
    }

    public function payments(): Response
    {
        return $this->renderPage(
            'Payments',
            [
                'payments' => config('site_content.payments'),
            ],
            'Payments | Imaging Services',
            'Send checks, deposits, and payment confirmations to Imaging Services with secure support for bank transfer and credit cards.'
        );
    }

    public function privacy(): Response
    {
        return $this->renderPage(
            'Privacy',
            [
                'privacy' => config('site_content.privacy'),
            ],
            'Privacy Policy and Terms | Imaging Services',
            'Review Imaging Services privacy policy details and website terms of service.'
        );
    }

    public function media(): Response
    {
        $posts = config('site_content.blog_posts');

        if (is_array($posts)) {
            $posts = $this->appendBlogPostUrls($posts);
        }

        return $this->renderPage(
            'Media',
            [
                'posts' => $posts,
            ],
            'Media | Imaging Services',
            'Browse interviews, operational insights, and digital imaging articles from Imaging Services.'
        );
    }

    public function equipmentDetail(string $equipmentSlug): Response
    {
        $equipmentMap = config('site_content.equipment_details');
        abort_unless(is_array($equipmentMap) && isset($equipmentMap[$equipmentSlug]) && is_array($equipmentMap[$equipmentSlug]), 404);

        $equipment = $equipmentMap[$equipmentSlug];

        return $this->renderPage(
            'EquipmentDetail',
            [
                'equipment' => [
                    ...$equipment,
                    'backUrl' => route('equipment'),
                ],
                'equipmentSlug' => $equipmentSlug,
            ],
            $equipment['title'].' | Imaging Services',
            $equipment['subtitle']
        );
    }

    public function blogPost(string $postSlug): Response
    {
        $postMap = config('site_content.blog_posts');
        abort_unless(is_array($postMap) && isset($postMap[$postSlug]) && is_array($postMap[$postSlug]), 404);

        $post = $postMap[$postSlug];

        return $this->renderPage(
            'BlogPost',
            [
                'post' => [
                    ...$post,
                    'backUrl' => route('media'),
                ],
                'postSlug' => $postSlug,
            ],
            $post['title'].' | Imaging Services Media',
            $post['summary']
        );
    }

    public function marketingPage(string $pageSlug): Response
    {
        $pages = config('site_content.marketing_pages');
        abort_unless(is_array($pages) && isset($pages[$pageSlug]) && is_array($pages[$pageSlug]), 404);

        $page = $pages[$pageSlug];

        $cta = $page['cta'] ?? null;
        $ctaUrl = '#';

        if (is_array($cta) && isset($cta['route']) && is_string($cta['route'])) {
            $ctaUrl = route($cta['route']);
        }

        return $this->renderPage(
            'MarketingPage',
            [
                'page' => [
                    ...$page,
                    'ctaUrl' => $ctaUrl,
                    'homeUrl' => route('home'),
                ],
                'pageSlug' => $pageSlug,
            ],
            $page['title'].' | Imaging Services',
            $page['description']
        );
    }

    /**
     * @param  array<string,mixed>  $data
     */
    private function renderPage(string $component, array $data, string $title, string $description): Response
    {
        return Inertia::render($component, [
            ...$data,
            'meta' => [
                'title' => $title,
                'description' => $description,
            ],
        ]);
    }

    /**
     * @param  array<int,array<string,mixed>>  $items
     * @return array<int,array<string,mixed>>
     */
    private function appendEquipmentDetailUrls(array $items): array
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
    private function appendBlogPostUrls(array $posts): array
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
    private function appendRouteUrl(array $cta): array
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

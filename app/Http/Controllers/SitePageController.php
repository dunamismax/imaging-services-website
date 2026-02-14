<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SitePageController extends Controller
{
    public function home(): View
    {
        return $this->renderPage(
            'pages.home',
            [
                'company' => config('site_content.company'),
                'hours' => config('site_content.hours'),
                'home' => config('site_content.home'),
                'partners' => config('site_content.partners'),
            ],
            'Imaging Services | Digital X-Ray Equipment, Service, and Support',
            'Imaging Services provides digital X-ray equipment, accessories, service, training, and workflow support for clinics nationwide.'
        );
    }

    public function about(): View
    {
        return $this->renderPage(
            'pages.about',
            [
                'about' => config('site_content.about'),
                'partners' => config('site_content.partners'),
            ],
            'About Us | Imaging Services',
            'Meet the Imaging Services team supporting digital imaging operations, equipment lifecycle planning, and dependable technical service.'
        );
    }

    public function equipment(): View
    {
        return $this->renderPage(
            'pages.equipment',
            [
                'equipment' => config('site_content.equipment'),
                'partners' => config('site_content.partners'),
            ],
            'Equipment | Imaging Services',
            'Explore chiropractic, podiatry, veterinary, mobile, and specialty digital X-ray equipment backed by Imaging Services support.'
        );
    }

    public function services(): View
    {
        return $this->renderPage(
            'pages.services',
            [
                'services' => config('site_content.services'),
                'partners' => config('site_content.partners'),
            ],
            'Services and Training | Imaging Services',
            'Request setup, maintenance, repair, remote support, and equipment training from the Imaging Services technical team.'
        );
    }

    public function accessories(): View
    {
        return $this->renderPage(
            'pages.accessories',
            [
                'accessories' => config('site_content.accessories'),
                'partners' => config('site_content.partners'),
            ],
            'Accessories | Imaging Services',
            'Browse imaging accessories catalogs, order workflows, and support details from Imaging Services.'
        );
    }

    public function contact(): View
    {
        $services = config('site_content.services');

        return $this->renderPage(
            'pages.contact',
            [
                'contact' => config('site_content.contact'),
                'company' => config('site_content.company'),
                'hours' => config('site_content.hours'),
                'serviceOptions' => is_array($services) ? ($services['service_options'] ?? []) : [],
                'trainingOptions' => is_array($services) ? ($services['training_options'] ?? []) : [],
            ],
            'Contact Us | Imaging Services',
            'Contact Imaging Services for equipment sales, accessories, service requests, and training support.'
        );
    }

    public function payments(): View
    {
        return $this->renderPage(
            'pages.payments',
            [
                'payments' => config('site_content.payments'),
                'company' => config('site_content.company'),
            ],
            'Payments | Imaging Services',
            'Send checks, deposits, and payment confirmations to Imaging Services with secure support for bank transfer and credit cards.'
        );
    }

    public function privacy(): View
    {
        return $this->renderPage(
            'pages.privacy',
            [
                'privacy' => config('site_content.privacy'),
                'company' => config('site_content.company'),
            ],
            'Privacy Policy and Terms | Imaging Services',
            'Review Imaging Services privacy policy details and website terms of service.'
        );
    }

    public function media(): View
    {
        return $this->renderPage(
            'pages.media',
            [
                'posts' => config('site_content.blog_posts'),
            ],
            'Media | Imaging Services',
            'Browse interviews, operational insights, and digital imaging articles from Imaging Services.'
        );
    }

    public function equipmentDetail(string $equipmentSlug): View
    {
        $equipmentMap = config('site_content.equipment_details');
        abort_unless(is_array($equipmentMap) && isset($equipmentMap[$equipmentSlug]) && is_array($equipmentMap[$equipmentSlug]), 404);

        $equipment = $equipmentMap[$equipmentSlug];

        return $this->renderPage(
            'pages.equipment-detail',
            [
                'equipment' => $equipment,
                'equipmentSlug' => $equipmentSlug,
            ],
            $equipment['title'].' | Imaging Services',
            $equipment['subtitle']
        );
    }

    public function blogPost(string $postSlug): View
    {
        $postMap = config('site_content.blog_posts');
        abort_unless(is_array($postMap) && isset($postMap[$postSlug]) && is_array($postMap[$postSlug]), 404);

        $post = $postMap[$postSlug];

        return $this->renderPage(
            'pages.blog-post',
            [
                'post' => $post,
                'postSlug' => $postSlug,
            ],
            $post['title'].' | Imaging Services Media',
            $post['summary']
        );
    }

    public function marketingPage(string $pageSlug): View
    {
        $pages = config('site_content.marketing_pages');
        abort_unless(is_array($pages) && isset($pages[$pageSlug]) && is_array($pages[$pageSlug]), 404);

        $page = $pages[$pageSlug];

        return $this->renderPage(
            'pages.marketing-page',
            [
                'page' => $page,
                'pageSlug' => $pageSlug,
            ],
            $page['title'].' | Imaging Services',
            $page['description']
        );
    }

    /**
     * @param  array<string,mixed>  $data
     */
    private function renderPage(string $view, array $data, string $title, string $description): View
    {
        return view($view, [
            ...$data,
            'title' => $title,
            'description' => $description,
        ]);
    }
}

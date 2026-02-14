<?php

it('serves public company pages and posts', function (string $path) {
    $this->get($path)->assertSuccessful();
})->with([
    '/',
    '/about-us',
    '/equipment',
    '/equipment/chiropractic-x-ray',
    '/equipment/podiatry-x-ray',
    '/equipment/veterinary-x-ray',
    '/equipment/mobile-x-ray',
    '/equipment/extentrac-elite-m3d-device',
    '/equipment/smart-c-portable-mini-c-arm',
    '/equipment/planmeca-viso-for-chiropractic',
    '/equipment/planmed-verity-orthopedic-imaging',
    '/equipment/orthopedic-urgent-care',
    '/services',
    '/accessories',
    '/contact-us',
    '/contact',
    '/payments',
    '/media',
    '/privacy-policy-terms-of-use',
    '/used-equipment',
    '/october-2024-message',
    '/promo-eq-summer-24',
    '/careers',
    '/refund_returns',
    '/shop',
    '/compare',
    '/wishlist',
    '/maintenance-page',
    '/are-you-an-active-participant-in-your-growth',
    '/chiropractic-rocks-2019-interview-with-jim-chester',
    '/the-chiropractic-compass-podcast-interview-19',
    '/celebrating-45-years-of-services-in-digiting-imaging',
    '/the-hidden-costs-of-outdated-x-ray-processors-is-it-time-to-upgrade',
    '/why-your-x-ray-processor-is-holding-you-back-5-signs-its-time-for-a-change',
    '/beyond-the-basics-how-to-maximize-the-roi-of-your-digital-x-ray-equipment',
    '/the-future-of-digital-x-ray-5-game-changing-innovations-to-watch',
    '/reducing-radiation-exposure-how-modern-digital-x-ray-systems-are-making-imaging-safer',
    '/the-economics-of-digital-x-ray-is-it-actually-saving-you-money',
]);

it('includes the theme bootstrap script on the app shell', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee("const themeStorageKey = 'site-theme';", false)
        ->assertSee("root.classList.toggle('dark', shouldUseDark);", false);
});

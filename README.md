<p align="center">
  <img src="public/favicon.svg" alt="Imaging Services logo" width="84" />
</p>

<p align="center">
  Laravel + Livewire website rebuild for Imaging Services USA with full public sitemap coverage.
</p>

# Imaging Services Website

This repository contains the Laravel 12 rebuild of the Imaging Services USA website using a Livewire-driven frontend. It is designed for fast content updates, reliable form handling, and complete route coverage for the company’s public pages and media posts.

## Trust Signals

![PHP](https://img.shields.io/badge/PHP-8.4%2B-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4.x-f9322c)
![Tests](https://img.shields.io/badge/Tested_with-Pest_4-2E9F5E)
![License](https://img.shields.io/badge/License-MIT-blue)

## Quick Start

### Prerequisites

- PHP `8.4+`
- Composer `2.x`
- SQLite `3+`

### Run

```bash
git clone <repo-url> imaging-services-website
cd imaging-services-website
composer setup
composer dev
```

Expected result:

- Website available at `http://127.0.0.1:8000`

Optional local seed data:

- Not required. Public website content is configuration-driven via `config/site_content.php`.

## Features

- Livewire full-page routes for all public sitemap slugs (home, equipment, services, accessories, contact, payments, privacy, media, and marketing pages).
- Dynamic equipment detail pages mapped by slug with dedicated highlights and brochure links where available.
- Dynamic media/article pages mapped by slug from centralized content configuration.
- Rebuilt sales, service, and training forms with Livewire actions, server-side validation, success states, and per-IP submission throttling.
- Shared responsive site shell with branded navigation, footer, and SEO metadata handling.
- Route and form behavior protected by Pest feature tests.

## Tech Stack

| Layer | Technology | Purpose |
|---|---|---|
| Backend | [PHP 8.4+](https://www.php.net/) | Application runtime |
| Framework | [Laravel 12](https://laravel.com/docs/12.x) | Routing, middleware, app structure, testing utilities |
| UI | [Livewire 4](https://livewire.laravel.com/) | SPA-like navigation (`wire:navigate`) and dynamic page/form behavior |
| Styling | [Tailwind CSS 4](https://tailwindcss.com/docs) | Utility-first styling and theme system |
| Data | SQLite | Local development/test database |
| Testing | [Pest 4](https://pestphp.com/docs/installation) + PHPUnit 12 | Feature and unit test execution |
| Code Style | [Laravel Pint](https://laravel.com/docs/12.x/pint) | Formatting and style consistency |

## Project Structure

```sh
imaging-services-website/
├── app/Livewire/Pages/                  # Full-page Livewire components
├── app/Livewire/Forms/                  # Reusable Livewire form components
├── config/site_content.php             # Central content map (routes, copy, metadata)
├── resources/views/layouts/site.blade.php # Shared Livewire layout shell
├── resources/views/livewire/           # Livewire page and form views
├── resources/css/app.css               # Tailwind + custom site theme styles
├── public/site-assets/css/app.css      # Compiled stylesheet served by Blade layout
├── routes/web.php                      # Public route definitions and slug mappings
├── tests/Feature/                      # Route coverage + form behavior tests
└── .github/workflows/                  # CI workflows for linting and tests
```

## Development Workflow and Common Commands

### Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --no-interaction
```

### Run

```bash
composer dev
```

Alternative run mode:

```bash
php artisan serve
```

### Test

```bash
php artisan test --compact
php artisan test --compact tests/Feature/SiteRoutesTest.php
php artisan test --compact tests/Feature/SiteFormsTest.php
```

### Lint and Format

```bash
vendor/bin/pint --dirty --format agent
```

### Deploy (Generic Flow)

```bash
php artisan migrate --no-interaction
php artisan optimize
```

Command verification notes for this README rewrite:

- Verified in this environment: `vendor/bin/pint --dirty --format agent`, `php artisan test --compact`, `php artisan route:list`
- Not executed in this rewrite: `composer setup`, `composer dev`, `php artisan migrate --no-interaction`, production deployment commands

## Deployment and Operations

- Deployment style: no platform-specific manifests are shipped in this repo (no Dockerfile / compose / PaaS config in source).
- Migration expectation: run `php artisan migrate --no-interaction` during deploy.
- Health check endpoint: `GET /up` (Laravel health route).
- Logs and diagnostics:
  - App logs: `storage/logs/laravel.log`
  - Stream logs locally: `php artisan pail`
- Rollback note: redeploy the previous known-good commit and run schema rollback only when the release includes reversible migrations.

## Security and Reliability Notes

- Public form inputs are validated server-side in Livewire component actions.
- Form submissions are rate-limited per IP via `RateLimiter` in `app/Livewire/Forms/Concerns/GuardsSiteFormRateLimit.php`.
- CSRF/session/cookie middleware is enforced by Laravel’s default web middleware stack.
- Secrets are environment-driven via `.env`; no runtime secrets are stored in source.
- CI workflows run lint and tests on pushes/PRs via `.github/workflows/lint.yml` and `.github/workflows/tests.yml`.
- This project is currently a public-facing brochure/lead site; no user authentication or admin panel is included in this codebase.

## Documentation

| Path | Purpose |
|---|---|
| [AGENTS.md](AGENTS.md) | Repository-specific working rules and Laravel guidelines |
| [config/site_content.php](config/site_content.php) | Source-of-truth content map used by routes and pages |
| [routes/web.php](routes/web.php) | Public route definitions and slug mapping |
| [tests/Feature/SiteRoutesTest.php](tests/Feature/SiteRoutesTest.php) | Sitemap/public route availability coverage |
| [tests/Feature/SiteFormsTest.php](tests/Feature/SiteFormsTest.php) | Form validation and submission behavior tests |
| [.github/workflows/lint.yml](.github/workflows/lint.yml) | CI lint workflow |
| [.github/workflows/tests.yml](.github/workflows/tests.yml) | CI test workflow |

## Contributing

1. Create a branch for your change.
2. Keep updates small and aligned with existing Laravel/Livewire conventions.
3. Run formatting and tests before opening a PR:
   - `vendor/bin/pint --dirty --format agent`
   - `php artisan test --compact`
4. Update documentation in the same PR when behavior or commands change.

## License

Licensed under the [MIT License](LICENSE).

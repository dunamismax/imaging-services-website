@php
    $siteData = is_array($site ?? null) ? $site : [];
    $company = is_array($siteData['company'] ?? null) ? $siteData['company'] : [];
@endphp

<section class="page-shell page-shell-medium page-section">
    <div class="surface-card p-6 md:p-8">
        <p class="brand-pill">Privacy Policy and Terms</p>
        <h1 class="mt-4 page-title text-brand-deep">Privacy Policy and Terms of Use</h1>
        <p class="mt-2 text-sm uppercase tracking-[0.12em] text-brand-accent">Effective Date: {{ $privacy['effective_date'] ?? '' }}</p>
    </div>

    <article class="surface-card mt-6 p-6">
        <p class="page-body">{{ $privacy['summary'] ?? '' }}</p>

        @foreach (($privacy['sections'] ?? []) as $section)
            <div class="mt-6">
                <h2 class="card-title text-brand-deep">{{ $section['title'] ?? '' }}</h2>
                <ul class="mt-3 space-y-2">
                    @foreach (($section['body'] ?? []) as $line)
                        <li class="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted">{{ $line }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        <div class="mt-6 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
            <p><strong>{{ $company['legal_name'] ?? '' }}</strong></p>
            <p class="mt-1">Phone: {{ $company['phone_primary'] ?? '' }}</p>
            <p class="mt-1">Address: {{ $company['hq_address'] ?? '' }}</p>
        </div>
    </article>
</section>

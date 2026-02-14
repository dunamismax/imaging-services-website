<section class="mx-auto mt-10 max-w-5xl px-4 lg:px-8">
    <p class="brand-pill">Privacy Policy and Terms</p>
    <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Privacy and terms of service</h1>
    <p class="mt-2 text-sm uppercase tracking-[0.12em] text-brand-accent">Effective Date: {{ $privacy['effective_date'] }}</p>

    <article class="surface-card mt-6 p-6">
        <p class="text-base text-brand-muted">{{ $privacy['summary'] }}</p>

        @foreach ($privacy['sections'] as $section)
            <div class="mt-6" wire:key="privacy-section-{{ $loop->index }}">
                <h2 class="font-display text-2xl font-semibold text-brand-deep">{{ $section['title'] }}</h2>
                <ul class="mt-3 space-y-2">
                    @foreach ($section['body'] as $line)
                        <li class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted" wire:key="privacy-line-{{ $loop->parent->index }}-{{ $loop->index }}">{{ $line }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        <div class="mt-6 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
            <p><strong>{{ $company['legal_name'] }}</strong></p>
            <p class="mt-1">Phone: {{ $company['phone_primary'] }}</p>
            <p class="mt-1">Address: {{ $company['hq_address'] }}</p>
        </div>
    </article>
</section>

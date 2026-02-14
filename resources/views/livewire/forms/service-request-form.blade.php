<div class="surface-card p-6">
    <p class="brand-pill">Service Request</p>
    <h3 class="mt-2 font-display text-2xl font-semibold text-brand-deep">Request our service</h3>

    @if ($submitted)
        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ $successMessage }}
        </div>
    @endif

    @error('form')
        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">{{ $message }}</div>
    @enderror

    <form wire:submit="submit" class="mt-5 space-y-4">
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="service-name" class="form-label">Your Name</label>
                <input id="service-name" type="text" wire:model.live.blur="name" class="form-field" maxlength="60">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="service-company" class="form-label">Your Company</label>
                <input id="service-company" type="text" wire:model.live.blur="company" class="form-field" maxlength="60">
                @error('company') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="service-phone" class="form-label">Your Phone Number</label>
                <input id="service-phone" type="text" wire:model.live.blur="phone" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="service-email" class="form-label">Your Best Email</label>
                <input id="service-email" type="email" wire:model.live.blur="email" class="form-field" maxlength="255">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <fieldset>
            <legend class="form-label">Select one or more options</legend>
            <div class="grid gap-2 sm:grid-cols-2">
                @foreach ($options as $option)
                    <label class="flex items-start gap-2 rounded-xl border border-brand-ink/10 bg-white px-3 py-2 text-sm text-brand-muted" wire:key="service-option-{{ $loop->index }}">
                        <input type="checkbox" value="{{ $option }}" wire:model="serviceOptions" class="mt-0.5 size-4 rounded border-brand-ink/20 text-brand-accent">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('serviceOptions') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('serviceOptions.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </fieldset>

        <div>
            <label for="service-notes" class="form-label">Anything Else?</label>
            <textarea id="service-notes" wire:model.live.blur="notes" class="form-field min-h-24" maxlength="1000"></textarea>
            @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary w-full" wire:loading.attr="disabled">
            <span wire:loading.remove>Request Service</span>
            <span wire:loading>Sending...</span>
        </button>
    </form>
</div>

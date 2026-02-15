<div class="surface-card p-6">
    <div class="mb-6 flex items-center justify-between gap-3">
        <div>
            <p class="brand-pill">Contact Sales</p>
            <h3 class="mt-2 card-title text-brand-deep">Request more information</h3>
        </div>
    </div>

    @if ($submitted)
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ $successMessage }}
        </div>
    @endif

    @error('form')
        <div class="mb-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
            {{ $message }}
        </div>
    @enderror

    <form class="space-y-4" wire:submit="submit" novalidate>
        <div>
            <label for="sales-name" class="form-label">Your Name</label>
            <input id="sales-name" wire:model.blur="name" type="text" class="form-field" maxlength="60">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="sales-phone" class="form-label">Your Phone Number</label>
                <input id="sales-phone" wire:model.blur="phone" type="text" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="sales-email" class="form-label">Your Best Email</label>
                <input id="sales-email" wire:model.blur="email" type="email" class="form-field" maxlength="255">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="sales-company" class="form-label">Your Company (Optional)</label>
            <input id="sales-company" wire:model.blur="company" type="text" class="form-field" maxlength="60">
            @error('company') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="sales-notes" class="form-label">Anything Else of Note?</label>
            <textarea id="sales-notes" wire:model.blur="notes" class="form-field min-h-28" maxlength="1000"></textarea>
            @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary w-full" wire:loading.attr="disabled" wire:target="submit">
            <span wire:loading.remove wire:target="submit">Contact Sales</span>
            <span wire:loading wire:target="submit">Sending...</span>
        </button>
    </form>
</div>

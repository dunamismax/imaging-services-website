<div class="surface-card p-6">
    <div class="mb-6 flex items-center justify-between gap-3">
        <div>
            <p class="brand-pill">Contact Sales</p>
            <h3 class="mt-2 font-display text-2xl font-semibold text-brand-deep">Request more information</h3>
        </div>
    </div>

    @if ($submitted)
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ $successMessage }}
        </div>
    @endif

    @error('form')
        <div class="mb-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">{{ $message }}</div>
    @enderror

    <form wire:submit="submit" class="space-y-4">
        <div>
            <label for="sales-name" class="form-label">Your Name</label>
            <input id="sales-name" type="text" wire:model.live.blur="name" class="form-field" maxlength="60">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="sales-phone" class="form-label">Your Phone Number</label>
                <input id="sales-phone" type="text" wire:model.live.blur="phone" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="sales-email" class="form-label">Your Best Email</label>
                <input id="sales-email" type="email" wire:model.live.blur="email" class="form-field" maxlength="255">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="sales-company" class="form-label">Your Company (Optional)</label>
            <input id="sales-company" type="text" wire:model.live.blur="company" class="form-field" maxlength="60">
            @error('company') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="sales-notes" class="form-label">Anything Else of Note?</label>
            <textarea id="sales-notes" wire:model.live.blur="notes" class="form-field min-h-28" maxlength="1000"></textarea>
            @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary w-full" wire:loading.attr="disabled">
            <span wire:loading.remove>Contact Sales</span>
            <span wire:loading>Sending...</span>
        </button>
    </form>
</div>

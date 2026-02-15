@php
    $idPrefix = strtolower(str_replace('_', '-', preg_replace('/([a-z])([A-Z])/', '$1-$2', $formKey)));
@endphp

<div class="surface-card p-6">
    <p class="brand-pill">{{ $pillLabel }}</p>
    <h3 class="mt-2 card-title text-brand-deep">{{ $headingLabel }}</h3>

    @if ($submitted)
        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ $successMessage }}
        </div>
    @endif

    @error('form')
        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
            {{ $message }}
        </div>
    @enderror

    <form class="mt-5 space-y-4" wire:submit="submit" novalidate>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="{{ $idPrefix }}-name" class="form-label">Your Name</label>
                <input id="{{ $idPrefix }}-name" wire:model.blur="name" type="text" class="form-field" maxlength="60">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="{{ $idPrefix }}-company" class="form-label">Your Company{{ $requireCompany ? '' : ' (Optional)' }}</label>
                <input id="{{ $idPrefix }}-company" wire:model.blur="company" type="text" class="form-field" maxlength="60">
                @error('company') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="{{ $idPrefix }}-phone" class="form-label">Your Phone Number</label>
                <input id="{{ $idPrefix }}-phone" wire:model.blur="phone" type="text" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="{{ $idPrefix }}-email" class="form-label">Your Best Email</label>
                <input id="{{ $idPrefix }}-email" wire:model.blur="email" type="email" class="form-field" maxlength="255">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <fieldset>
            <legend class="form-label">{{ $optionsLegend }}</legend>
            <div class="grid gap-2 sm:grid-cols-2">
                @foreach ($options as $option)
                    <label class="flex items-start gap-2 rounded-xl border border-brand-ink/10 bg-site-panel px-3 py-2 text-sm text-brand-muted transition hover:border-brand-ink/20">
                        <input
                            wire:model="selectedOptions"
                            type="checkbox"
                            value="{{ $option }}"
                            class="mt-0.5 size-4 rounded border-brand-ink/20 text-brand-accent"
                        >
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
            @error('selectedOptions') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('selectedOptions.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </fieldset>

        <div>
            <label for="{{ $idPrefix }}-notes" class="form-label">Anything Else?</label>
            <textarea id="{{ $idPrefix }}-notes" wire:model.blur="notes" class="form-field min-h-24" maxlength="1000"></textarea>
            @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary w-full" wire:loading.attr="disabled" wire:target="submit">
            <span wire:loading.remove wire:target="submit">{{ $buttonLabel }}</span>
            <span wire:loading wire:target="submit">Sending...</span>
        </button>
    </form>
</div>

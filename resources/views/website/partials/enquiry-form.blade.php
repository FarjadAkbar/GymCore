@props(['returnTo' => 'join'])

@if (session('enquiry_submitted'))
    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900" role="status">
        {{ __('app.website.enquiry.success') }}
    </div>
@endif

<form method="post" action="{{ route('website.enquiry.store') }}" class="space-y-4">
    @csrf
    <input type="hidden" name="return_to" value="{{ $returnTo }}">

    <div>
        <label for="enquiry-name" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.website.join.full_name') }}</label>
        <input id="enquiry-name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" class="w-full rounded-lg border border-stone-300 bg-white px-3 py-2.5 text-stone-900 focus:border-gymie-600 focus:outline-none focus:ring-2 focus:ring-gymie-200">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="enquiry-father" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.fields.father_name') }}</label>
        <input id="enquiry-father" name="father_name" type="text" value="{{ old('father_name') }}" required autocomplete="additional-name" class="w-full rounded-lg border border-stone-300 bg-white px-3 py-2.5 text-stone-900 focus:border-gymie-600 focus:outline-none focus:ring-2 focus:ring-gymie-200">
        @error('father_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="enquiry-contact" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.website.join.phone') }}</label>
        <input id="enquiry-contact" name="contact" type="tel" value="{{ old('contact') }}" required autocomplete="tel" class="w-full rounded-lg border border-stone-300 bg-white px-3 py-2.5 text-stone-900 focus:border-gymie-600 focus:outline-none focus:ring-2 focus:ring-gymie-200">
        @error('contact')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="enquiry-plan" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.website.join.fee') }}</label>
        <select id="enquiry-plan" name="plan_id" @if ($plans->isNotEmpty()) required @endif @disabled($plans->isEmpty()) class="w-full rounded-lg border border-stone-300 bg-white px-3 py-2.5 text-stone-900 focus:border-gymie-600 focus:outline-none focus:ring-2 focus:ring-gymie-200">
            <option value="">{{ __('app.website.join.fee_placeholder') }}</option>
            @foreach ($plans as $plan)
                <option value="{{ $plan->id }}" @selected((string) old('plan_id') === (string) $plan->id)>
                    {{ $plan->name }} — {{ \App\Helpers\Helpers::formatCurrency((float) $plan->amount) }}
                </option>
            @endforeach
        </select>
        @error('plan_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="site-btn w-full rounded-full py-3 text-sm font-semibold">
        {{ __('app.website.enquiry.submit') }}
    </button>
</form>

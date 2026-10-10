@props(['returnTo' => 'join'])

@if (session('enquiry_submitted'))
    <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900" role="status">
        {{ __('app.website.enquiry.success') }}
    </div>
@endif

<form method="post" action="{{ route('website.enquiry.store') }}" {{ $attributes->merge(['class' => 'space-y-4']) }}>
    @csrf
    <input type="hidden" name="return_to" value="{{ $returnTo }}">

    <div>
        <label for="enquiry-name" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.fields.name') }}</label>
        <input id="enquiry-name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name"
            class="w-full rounded-xl border border-stone-200 bg-stone-50/80 px-4 py-2.5 text-stone-900 transition focus:border-gymie-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gymie-200/80">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="enquiry-contact" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.fields.contact') }}</label>
        <input id="enquiry-contact" name="contact" type="tel" value="{{ old('contact') }}" required autocomplete="tel"
            class="w-full rounded-xl border border-stone-200 bg-stone-50/80 px-4 py-2.5 text-stone-900 transition focus:border-gymie-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gymie-200/80">
        @error('contact')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="enquiry-email" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.fields.email') }}</label>
        <input id="enquiry-email" name="email" type="email" value="{{ old('email') }}" autocomplete="email"
            class="w-full rounded-xl border border-stone-200 bg-stone-50/80 px-4 py-2.5 text-stone-900 transition focus:border-gymie-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gymie-200/80">
        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="enquiry-goal" class="mb-1.5 block text-sm font-medium text-stone-700">{{ __('app.fields.goal') }}</label>
        <input id="enquiry-goal" name="goal" type="text" value="{{ old('goal') }}" placeholder="{{ __('app.website.enquiry.goal_placeholder') }}"
            class="w-full rounded-xl border border-stone-200 bg-stone-50/80 px-4 py-2.5 text-stone-900 transition focus:border-gymie-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gymie-200/80">
        @error('goal')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="w-full rounded-xl bg-gymie-700 py-3 text-sm font-semibold text-white shadow-md shadow-gymie-900/10 transition hover:bg-gymie-800">
        {{ __('app.website.enquiry.submit') }}
    </button>
</form>

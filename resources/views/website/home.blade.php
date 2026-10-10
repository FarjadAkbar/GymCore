@extends('website.layout')

@section('title', $gymName)

@section('content')
    <section class="relative overflow-hidden bg-gymie-950 text-white">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1800&q=80" alt="" class="h-full w-full object-cover opacity-35">
            <div class="absolute inset-0 bg-gradient-to-r from-gymie-950 via-gymie-950/90 to-gymie-950/40"></div>
        </div>
        <div class="relative mx-auto grid max-w-6xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.2fr_0.8fr] lg:items-center lg:py-24">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gymie-100">{{ $gymName }}</p>
                <h1 class="mt-3 text-4xl font-semibold leading-tight tracking-tight sm:text-5xl">{{ __('app.website.hero.headline') }}</h1>
                <p class="mt-5 max-w-xl text-lg leading-relaxed text-stone-200">{{ __('app.website.hero.lead') }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#join" class="rounded-lg bg-white px-5 py-3 text-sm font-semibold text-gymie-950 hover:bg-gymie-50">{{ __('app.website.hero.join_cta') }}</a>
                    <a href="#fees" class="rounded-lg border border-white/30 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10">{{ __('app.website.hero.fees_cta') }}</a>
                </div>
            </div>
            <div class="grid gap-3 sm:grid-cols-3 lg:grid-cols-1">
                <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <p class="text-xs uppercase tracking-wider text-gymie-100">{{ __('app.website.facts.floor') }}</p>
                    <p class="mt-1 text-lg font-semibold">{{ __('app.website.facts.floor_value') }}</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <p class="text-xs uppercase tracking-wider text-gymie-100">{{ __('app.website.facts.coaching') }}</p>
                    <p class="mt-1 text-lg font-semibold">{{ __('app.website.facts.coaching_value') }}</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <p class="text-xs uppercase tracking-wider text-gymie-100">{{ __('app.website.facts.checkin') }}</p>
                    <p class="mt-1 text-lg font-semibold">{{ __('app.website.facts.checkin_value') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200 bg-white">
        <div class="mx-auto grid max-w-6xl gap-6 px-4 py-8 sm:px-6 md:grid-cols-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">{{ __('app.website.nav.timings') }}</p>
                <p class="mt-1 font-medium">{{ __('app.website.timings.hours') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">{{ __('app.fields.contact') }}</p>
                <p class="mt-1 font-medium">{{ $gymContact ?: __('app.website.visit.call_desk') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">{{ __('app.fields.address') }}</p>
                <p class="mt-1 font-medium">{{ $gymAddress ?: __('app.website.visit.ask_address') }}</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <div class="max-w-2xl">
            <h2 class="text-3xl font-semibold tracking-tight text-gymie-950">{{ __('app.website.floor.title') }}</h2>
            <p class="mt-3 text-stone-600">{{ __('app.website.floor.subtitle') }}</p>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach ([
                ['title' => __('app.website.floor.weights'), 'body' => __('app.website.floor.weights_body')],
                ['title' => __('app.website.floor.cardio'), 'body' => __('app.website.floor.cardio_body')],
                ['title' => __('app.website.floor.coaching'), 'body' => __('app.website.floor.coaching_body')],
            ] as $item)
                <article class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gymie-900">{{ $item['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-600">{{ $item['body'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section id="fees" class="scroll-mt-20 bg-white py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <h2 class="text-3xl font-semibold tracking-tight text-gymie-950">{{ __('app.website.fees.title') }}</h2>
                    <p class="mt-2 max-w-xl text-stone-600">{{ __('app.website.fees.subtitle') }}</p>
                </div>
            </div>
            @if ($plans->isEmpty())
                <p class="mt-8 rounded-2xl border border-dashed border-stone-300 bg-stone-50 px-5 py-8 text-stone-600">{{ __('app.website.fees.empty') }}</p>
            @else
                <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($plans as $plan)
                        <article class="flex flex-col rounded-2xl border border-stone-200 p-6 shadow-sm">
                            <h3 class="text-xl font-semibold text-gymie-950">{{ $plan->name }}</h3>
                            <p class="mt-3 text-3xl font-semibold tracking-tight text-gymie-800">{{ \App\Helpers\Helpers::formatCurrency((float) $plan->amount) }}</p>
                            <p class="mt-1 text-sm text-stone-500">{{ trans_choice('app.website.fees.days', (int) $plan->days, ['count' => (int) $plan->days]) }}</p>
                            @if ($plan->description)
                                <p class="mt-4 flex-1 text-sm leading-relaxed text-stone-600">{{ $plan->description }}</p>
                            @endif
                            <a href="#join" class="mt-6 text-sm font-semibold text-gymie-800 hover:underline">{{ __('app.website.fees.choose') }}</a>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section id="timings" class="scroll-mt-20 mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <div class="grid gap-8 rounded-3xl bg-gymie-900 px-6 py-10 text-white sm:px-10 lg:grid-cols-2">
            <div>
                <h2 class="text-3xl font-semibold">{{ __('app.website.timings.title') }}</h2>
                <p class="mt-3 text-gymie-100">{{ __('app.website.timings.body') }}</p>
            </div>
            <dl class="grid gap-4 text-sm">
                <div class="flex justify-between border-b border-white/15 pb-3">
                    <dt>{{ __('app.website.timings.weekdays') }}</dt>
                    <dd class="font-medium">{{ __('app.website.timings.hours') }}</dd>
                </div>
                <div class="flex justify-between border-b border-white/15 pb-3">
                    <dt>{{ __('app.website.timings.sunday') }}</dt>
                    <dd class="font-medium">{{ __('app.website.timings.sunday_hours') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt>{{ __('app.website.timings.checkin') }}</dt>
                    <dd class="font-medium">{{ __('app.website.timings.checkin_value') }}</dd>
                </div>
            </dl>
        </div>
    </section>

    <section id="visit" class="scroll-mt-20 bg-white py-16">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:items-start">
            <div id="join" class="scroll-mt-24">
                <h2 class="text-3xl font-semibold tracking-tight text-gymie-950">{{ __('app.website.join.title') }}</h2>
                <p class="mt-3 text-stone-600">{{ __('app.website.join.subtitle') }}</p>
                <div class="mt-8 rounded-2xl border border-stone-200 p-6 shadow-sm">
                    @include('website.partials.enquiry-form', ['returnTo' => 'home'])
                </div>
            </div>
            <div class="rounded-2xl bg-[#efeae1] p-8">
                <h3 class="text-xl font-semibold text-gymie-950">{{ __('app.website.visit.title') }}</h3>
                <p class="mt-3 text-sm leading-relaxed text-stone-700">{{ __('app.website.visit.body') }}</p>
                <dl class="mt-6 space-y-4 text-sm">
                    @if ($gymAddress)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wider text-stone-500">{{ __('app.fields.address') }}</dt>
                            <dd class="mt-1">{{ $gymAddress }}</dd>
                        </div>
                    @endif
                    @if ($gymContact)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wider text-stone-500">{{ __('app.fields.contact') }}</dt>
                            <dd class="mt-1">{{ $gymContact }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    </section>
@endsection

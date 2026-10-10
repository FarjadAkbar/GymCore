@extends('website.layout')

@section('title', $gymName)

@section('content')
    {{-- Hero (FunFitnessPro-inspired) --}}
    <section class="relative min-h-[92vh] overflow-hidden bg-neutral-950">
        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=2000&q=80" alt="" class="absolute inset-0 h-full w-full object-cover opacity-40" aria-hidden="true">
        <div class="absolute inset-0 bg-gradient-to-r from-neutral-950 via-neutral-950/85 to-neutral-950/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-transparent to-neutral-950/60"></div>

        <div class="relative mx-auto flex max-w-7xl flex-col gap-12 px-4 pb-20 pt-28 sm:px-6 lg:flex-row lg:items-center lg:gap-16 lg:px-8 lg:pt-32 lg:pb-28">
            <div class="flex-1">
                <div class="mb-8 flex flex-wrap gap-4 lg:gap-6">
                    @foreach ([
                        ['title' => __('app.website.hero_pills.endurance'), 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['title' => __('app.website.hero_pills.custom'), 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
                        ['title' => __('app.website.hero_pills.results'), 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                    ] as $pill)
                        <div class="flex max-w-[140px] flex-col items-center rounded-2xl border border-white/10 bg-white/5 px-3 py-4 text-center backdrop-blur-sm">
                            <svg class="mb-2 h-7 w-7 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $pill['icon'] }}"/></svg>
                            <span class="text-[10px] font-bold uppercase leading-tight tracking-wide text-white/90">{!! nl2br(e($pill['title'])) !!}</span>
                        </div>
                    @endforeach
                </div>

                <h1 class="font-display text-5xl leading-none text-white sm:text-6xl lg:text-7xl xl:text-8xl">
                    {{ __('app.website.hero.headline_line1') }}<br>
                    <span class="text-lime-400">{{ __('app.website.hero.headline_line2') }}</span>
                </h1>
                <p class="mt-6 max-w-xl text-base leading-relaxed text-neutral-300 sm:text-lg">
                    {{ __('app.website.hero.subtitle', ['gym' => $gymName]) }}
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="#enquiry" class="inline-flex items-center gap-2 rounded-full bg-lime-400 px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-neutral-950 hover:bg-lime-300">
                        {{ __('app.website.hero.cta_trial') }}
                        <span aria-hidden="true">→</span>
                    </a>
                    <a href="#plans" class="inline-flex items-center gap-2 rounded-full bg-white px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-neutral-950 hover:bg-neutral-100">
                        {{ __('app.website.hero.cta_membership') }}
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>

            <div class="hidden flex-1 lg:block">
                <div class="relative aspect-[4/5] max-h-[560px] overflow-hidden rounded-3xl border border-white/10 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?auto=format&fit=crop&w=1200&q=80" alt="" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- About --}}
    <section id="about" class="scroll-mt-24 border-y border-white/10 bg-neutral-900 py-20">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6">
            <h2 class="font-display text-4xl text-white sm:text-5xl">{{ __('app.website.about.title') }}</h2>
            <p class="mt-6 text-lg leading-relaxed text-neutral-400">{{ __('app.website.about.body', ['gym' => $gymName]) }}</p>
        </div>
    </section>

    {{-- Programs --}}
    <section id="programs" class="scroll-mt-24 py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ([
                    ['title' => __('app.website.programs.fat_loss'), 'desc' => __('app.website.programs.fat_loss_desc'), 'img' => 'photo-1517836357463-d25dfeac3430'],
                    ['title' => __('app.website.programs.strength'), 'desc' => __('app.website.programs.strength_desc'), 'img' => 'photo-1583454110551-21f2fa2ee61b'],
                    ['title' => __('app.website.programs.flexibility'), 'desc' => __('app.website.programs.flexibility_desc'), 'img' => 'photo-1544367567-0f2fcb009e0b'],
                    ['title' => __('app.website.programs.goals'), 'desc' => __('app.website.programs.goals_desc'), 'img' => 'photo-1518611012118-696072aa579a'],
                ] as $program)
                    <article class="group relative min-h-[280px] overflow-hidden rounded-2xl">
                        <img src="https://images.unsplash.com/{{ $program['img'] }}?auto=format&fit=crop&w=900&q=80" alt="" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-neutral-950/70 to-transparent"></div>
                        <div class="relative flex h-full flex-col justify-end p-8">
                            <h3 class="font-display text-3xl leading-tight text-white">{!! nl2br(e($program['title'])) !!}</h3>
                            <p class="mt-2 max-w-md text-sm text-neutral-300">{{ $program['desc'] }}</p>
                            <a href="#enquiry" class="mt-4 inline-flex w-fit text-xs font-bold uppercase tracking-widest text-lime-400 hover:text-lime-300">{{ __('app.website.programs.start_now') }} →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Plans --}}
    <section id="plans" class="scroll-mt-24 bg-neutral-900 py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center font-display text-4xl text-white sm:text-5xl">{{ __('app.website.plans.title') }}</h2>
            <p class="mx-auto mt-4 max-w-2xl text-center text-neutral-400">{{ __('app.website.plans.subtitle') }}</p>
            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ([
                    ['title' => __('app.website.plans.starter'), 'desc' => __('app.website.plans.starter_desc')],
                    ['title' => __('app.website.plans.pro'), 'desc' => __('app.website.plans.pro_desc'), 'featured' => true, 'badge' => __('app.website.plans.popular')],
                    ['title' => __('app.website.plans.elite'), 'desc' => __('app.website.plans.elite_desc')],
                ] as $plan)
                    <article @class([
                        'relative flex flex-col rounded-2xl border p-8',
                        'border-lime-400/50 bg-neutral-950' => $plan['featured'] ?? false,
                        'border-white/10 bg-neutral-950/50' => ! ($plan['featured'] ?? false),
                    ])>
                        @if (! empty($plan['badge']))
                            <span class="absolute -top-3 left-8 rounded-full bg-lime-400 px-3 py-1 text-xs font-bold uppercase text-neutral-950">{{ $plan['badge'] }}</span>
                        @endif
                        <h3 class="font-display text-2xl text-white">{{ $plan['title'] }}</h3>
                        <p class="mt-3 flex-1 text-sm text-neutral-400">{{ $plan['desc'] }}</p>
                        <a href="#enquiry" class="mt-6 inline-flex rounded-full border border-white/20 px-5 py-2.5 text-xs font-bold uppercase tracking-wide text-white hover:border-lime-400 hover:text-lime-400">{{ __('app.website.plans.enquire') }}</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Signup / enquiry --}}
    <section id="enquiry" class="scroll-mt-24 py-20 lg:py-28">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:items-center lg:px-8">
            <div>
                <h2 class="font-display text-4xl leading-tight text-white sm:text-5xl">{!! nl2br(e(__('app.website.enquiry.hero_title'))) !!}</h2>
                <p class="mt-4 text-neutral-400">{{ __('app.website.enquiry.subtitle') }}</p>
                @if ($gymContact)
                    <p class="mt-8 text-sm font-semibold uppercase tracking-widest text-lime-400">{{ __('app.website.enquiry.call_us') }} {{ $gymContact }}</p>
                @endif
            </div>
            <div class="rounded-2xl border border-white/10 bg-white p-6 text-neutral-900 shadow-2xl sm:p-8">
                <h3 class="text-lg font-bold">{{ __('app.website.enquiry.form_heading') }}</h3>
                <p class="mt-1 text-sm text-neutral-500">{{ __('app.website.enquiry.form_note') }}</p>
                <div class="mt-6">
                    @include('website.partials.enquiry-form', ['returnTo' => 'home'])
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('website.layout')

@section('title', $gymName.' — '.__('app.website.hero.headline'))

@section('content')
    <section class="landing-hero" aria-labelledby="hero-title">
        <img class="hero-background" src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=2000&q=85" alt="{{ __('app.website.landing.hero_alt') }}" fetchpriority="high" width="2000" height="1333">
        <div class="hero-shade"></div>
        <div class="landing-container hero-content">
            <p class="eyebrow"><span></span> {{ __('app.website.landing.eyebrow') }}</p>
            <h1 id="hero-title">{{ __('app.website.landing.headline') }} <em>{{ __('app.website.landing.headline_accent') }}</em></h1>
            <p class="hero-description">{{ __('app.website.landing.lead', ['gym' => $gymName]) }}</p>
            <div class="hero-actions">
                <a href="#join" class="site-btn">{{ __('app.website.landing.primary_cta') }} <span aria-hidden="true">↗</span></a>
                <a href="#experience" class="outline-btn">{{ __('app.website.landing.explore_cta') }} <span aria-hidden="true">↓</span></a>
            </div>
            <p class="hero-note">{{ __('app.website.landing.hero_note') }}</p>
        </div>
        <div class="hero-bottom landing-container"><span>{{ $gymName }}</span><span>{{ __('app.website.landing.hero_bottom') }}</span></div>
    </section>

    <section class="benefit-strip" aria-label="{{ __('app.website.features_section.title') }}">
        <div class="landing-container benefit-grid">
            @foreach ([['01', __('app.website.facts.floor_value'), __('app.website.landing.floor_note')], ['02', __('app.website.landing.plan_benefit'), __('app.website.landing.plan_note')], ['03', __('app.website.landing.start_benefit'), __('app.website.landing.start_note')]] as [$number, $title, $description])
                <div class="benefit"><span class="benefit-number">{{ $number }}</span><div><h2>{{ $title }}</h2><p>{{ $description }}</p></div></div>
            @endforeach
        </div>
    </section>

    <section id="experience" class="landing-container landing-section">
        <div class="section-heading"><div><p class="eyebrow dark">{{ __('app.website.landing.experience_eyebrow') }}</p><h2>{{ __('app.website.landing.experience_title') }}</h2></div><p>{{ __('app.website.landing.experience_body') }}</p></div>
        <div class="training-grid">
            @foreach ([
                ['photo-1534438327276-14e5300c3a48', __('app.website.floor.weights'), __('app.website.floor.weights_body'), __('app.website.landing.weights_alt'), '01'],
                ['photo-1571019613454-1cb2f99b2d8b', __('app.website.landing.movement_title'), __('app.website.landing.movement_body'), __('app.website.landing.movement_alt'), '02'],
                ['photo-1517836357463-d25dfeac3438', __('app.website.landing.routine_title'), __('app.website.landing.routine_body'), __('app.website.landing.routine_alt'), '03'],
            ] as [$photo, $title, $body, $alt, $number])
                <article class="training-card">
                    <div class="training-image"><img src="https://images.unsplash.com/{{ $photo }}?auto=format&fit=crop&w=800&q=80" alt="{{ $alt }}" loading="lazy" width="800" height="1000"><span>{{ $number }}</span></div>
                    <h3>{{ $title }}</h3><p>{{ $body }}</p>
                </article>
            @endforeach
        </div>
        <p class="image-note">{{ __('app.website.landing.image_note') }}</p>
    </section>

    <section class="start-section">
        <div class="landing-container start-grid">
            <div class="start-image"><img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?auto=format&fit=crop&w=1100&q=85" alt="{{ __('app.website.landing.start_alt') }}" loading="lazy" width="1100" height="1100"><div class="image-caption">{{ __('app.website.landing.image_caption') }}</div></div>
            <div class="start-copy"><p class="eyebrow dark">{{ __('app.website.landing.start_eyebrow') }}</p><h2>{{ __('app.website.landing.start_title') }}</h2><p class="section-intro">{{ __('app.website.landing.start_body') }}</p>
                <ol class="steps">
                    @foreach (['choose', 'enquire', 'visit'] as $step)
                        <li><span>0{{ $loop->iteration }}</span><div><h3>{{ __('app.website.landing.step_'.$step) }}</h3><p>{{ __('app.website.landing.step_'.$step.'_body') }}</p></div></li>
                    @endforeach
                </ol>
                <a href="#join" class="text-link">{{ __('app.website.landing.primary_cta') }} <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>

    <section id="fees" class="landing-container landing-section">
        <div class="section-heading"><div><p class="eyebrow dark">{{ __('app.website.landing.fees_eyebrow') }}</p><h2>{{ __('app.website.fees.title') }}</h2></div><p>{{ __('app.website.landing.fees_body') }}</p></div>
        @if ($plans->isEmpty())
            <div class="empty-plans"><h3>{{ __('app.website.landing.empty_title') }}</h3><p>{{ __('app.website.landing.empty_body') }}</p><a href="#join" class="site-btn">{{ __('app.website.contact.cta') }} <span aria-hidden="true">↗</span></a></div>
        @else
            <div class="plan-grid">
                @foreach ($plans as $plan)
                    <article class="plan-card">
                        <p class="plan-label">{{ __('app.website.landing.membership') }}</p><h3>{{ $plan->name }}</h3>
                        <p class="plan-price">{{ \App\Helpers\Helpers::formatCurrency((float) $plan->amount) }}</p>
                        <p class="plan-duration">{{ trans_choice('app.website.fees.days', (int) $plan->days, ['count' => (int) $plan->days]) }}</p>
                        @if ($plan->description)<p class="plan-description">{{ $plan->description }}</p>@endif
                        <a href="#join" class="plan-cta" data-plan-id="{{ $plan->id }}">{{ __('app.website.landing.choose_plan') }} <span aria-hidden="true">↗</span></a>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <section id="timings" class="visit-section"><div class="landing-container visit-grid">
        <div><p class="eyebrow">{{ __('app.website.landing.visit_eyebrow') }}</p><h2>{{ __('app.website.landing.visit_title') }}</h2><p>{{ __('app.website.landing.visit_body') }}</p>
            @if ($gymAddress)<address>{{ $gymAddress }}</address>@endif
            @if ($gymContact)<a class="contact-link" href="tel:{{ preg_replace('/[^+0-9]/', '', $gymContact) }}">{{ $gymContact }} <span aria-hidden="true">↗</span></a>@endif
        </div>
        <div class="hours-card"><h3>{{ __('app.website.timings.title') }}</h3><div><span>{{ __('app.website.timings.weekdays') }}</span><strong>{{ __('app.website.timings.hours') }}</strong></div><div><span>{{ __('app.website.timings.sunday') }}</span><strong>{{ __('app.website.timings.sunday_hours') }}</strong></div><p>{{ __('app.website.landing.hours_note') }}</p></div>
    </div></section>

    <section class="landing-container landing-section faq-section"><div><p class="eyebrow dark">{{ __('app.website.landing.faq_eyebrow') }}</p><h2>{{ __('app.website.landing.faq_title') }}</h2></div><div class="faq-list">
        @foreach (['beginner', 'plan', 'payment'] as $question)
            <details><summary>{{ __('app.website.landing.faq_'.$question) }}<span aria-hidden="true">+</span></summary><p>{{ __('app.website.landing.faq_'.$question.'_answer') }}</p></details>
        @endforeach
    </div></section>

    <section id="join" class="join-section"><div class="landing-container join-grid">
        <div class="join-copy"><p class="eyebrow dark">{{ __('app.website.landing.join_eyebrow') }}</p><h2>{{ __('app.website.landing.join_title') }}</h2><p>{{ __('app.website.landing.join_body') }}</p><div class="join-reassurance"><span aria-hidden="true">↗</span><div><strong>{{ __('app.website.landing.join_reassurance') }}</strong><p>{{ __('app.website.landing.join_reassurance_body') }}</p></div></div></div>
        <div id="enquiry" class="enquiry-card"><h3>{{ __('app.website.contact.cta') }}</h3><p class="form-intro">{{ __('app.website.landing.form_intro') }}</p>@include('website.partials.enquiry-form', ['returnTo' => 'home'])<p class="form-note">{{ __('app.website.landing.form_note') }}</p></div>
    </div></section>
@endsection

@extends('website.layout')

@section('title', __('app.website.join.title').' — '.$gymName)

@section('content')
    <section class="mx-auto max-w-lg px-4 py-14 sm:px-6">
        <h1 class="text-3xl font-semibold tracking-tight text-gymie-950">{{ __('app.website.join.title') }}</h1>
        <p class="mt-2 text-stone-600">{{ __('app.website.join.subtitle') }}</p>
        <div class="mt-8 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            @include('website.partials.enquiry-form', ['returnTo' => 'join'])
        </div>
    </section>
@endsection

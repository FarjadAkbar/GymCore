@extends('website.layout')

@section('title', __('app.website.enquiry.title').' — '.$gymName)

@section('content')
    <section class="mx-auto max-w-lg px-4 py-14 sm:px-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gymie-900">{{ __('app.website.enquiry.title') }}</h1>
            <p class="mt-2 text-stone-600">{{ __('app.website.enquiry.subtitle') }}</p>
        </div>
        <div class="mt-10 rounded-2xl border border-stone-200 bg-white p-6 shadow-lg shadow-stone-200/60 sm:p-8">
            @include('website.partials.enquiry-form', ['returnTo' => 'join'])
        </div>
        <p class="mt-6 text-center text-sm text-stone-500">
            <a href="{{ route('website.home') }}" class="font-medium text-gymie-800 hover:underline">{{ __('app.website.enquiry.back_home') }}</a>
        </p>
    </section>
@endsection

@extends('layouts.app')

@section('title', __('site.nav.services'))

@section('description', __('site.services_page.lead'))

@php
    $services = config('netware.services');
    $flow = [
        [__('site.services_page.flow_1_title'), __('site.services_page.flow_1_body')],
        [__('site.services_page.flow_2_title'), __('site.services_page.flow_2_body')],
        [__('site.services_page.flow_3_title'), __('site.services_page.flow_3_body')],
    ];
@endphp

@section('content')
    {{-- Hero: soft colour fields, deliberately unlike the grid that carries the rest of the page. --}}
    <section class="relative overflow-hidden border-b-2 border-slate-300 bg-slate-50 dark:border-slate-700 dark:bg-slate-950">
        {{-- Slow drifting colour pools; no lines, so the top of the page stands apart. --}}
        @include('partials.hero-backdrop')

        <div class="relative mx-auto grid max-w-7xl gap-10 px-5 py-10 sm:px-6 sm:py-12 lg:grid-cols-12 lg:items-end lg:gap-12 lg:px-8 lg:py-14">
            <div class="lg:col-span-7" data-reveal>
                <nav class="flex items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
                    <a href="{{ route('beranda') }}" class="transition-colors hover:text-netware-teal">{{ __('site.nav.home') }}</a>
                    <span aria-hidden="true">/</span>
                    <span class="text-slate-600 dark:text-slate-300">{{ __('site.nav.services') }}</span>
                </nav>

                <div class="mt-6 flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.services') }}</p>
                </div>

                <h1 class="mt-4 text-[2rem] leading-[1.1] font-semibold tracking-tight text-netware-navy sm:text-4xl lg:text-[2.9rem] dark:text-white">
                    {{ __('site.services_page.title_1') }}<br>
                    <span class="text-netware-teal">{{ __('site.services_page.title_2') }}</span>
                </h1>

                <p class="mt-5 max-w-xl text-sm leading-relaxed text-slate-600 sm:text-base dark:text-slate-400">
                    {{ __('site.services_page.lead') }}
                </p>
            </div>

            <div class="lg:col-span-5" data-reveal>
                <div class="border border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900">
                    <div class="border-b border-slate-300 px-4 py-3 dark:border-slate-700">
                        <p class="text-xs font-semibold tracking-[0.16em] text-slate-500 uppercase dark:text-slate-400">{{ __('site.labels.hours') }}</p>
                    </div>

                    <dl class="divide-y divide-slate-300 dark:divide-slate-700">
                        <div class="flex items-baseline justify-between gap-4 px-4 py-3">
                            <dt class="text-xs tracking-wide text-slate-400 uppercase">{{ __('site.labels.open') }}</dt>
                            <dd class="text-sm font-semibold tabular-nums text-netware-navy dark:text-white">{{ config('netware.hours.open') }} {{ config('netware.hours.timezone') }}</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4 px-4 py-3">
                            <dt class="text-xs tracking-wide text-slate-400 uppercase">{{ __('site.labels.close') }}</dt>
                            <dd class="text-sm font-semibold tabular-nums text-netware-navy dark:text-white">{{ config('netware.hours.close') }} {{ config('netware.hours.timezone') }}</dd>
                        </div>
                    </dl>

                    <p class="border-t border-slate-300 bg-netware-sand px-4 py-3 text-[11px] leading-relaxed text-amber-900 dark:border-slate-700 dark:bg-amber-500/10 dark:text-amber-200/90">
                        {{ config('netware.hours.note')[app()->getLocale()] ?? config('netware.hours.note.id') }}
                    </p>

                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-between gap-3 border-t border-slate-300 px-4 py-3 text-sm font-medium text-netware-navy transition-colors duration-200 hover:bg-slate-50 hover:text-netware-teal dark:border-slate-700 dark:text-white dark:hover:bg-slate-800"
                    >
                        <span class="inline-flex items-center gap-2">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.86 9.86 0 004.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm0 18.13h-.01a8.2 8.2 0 01-4.18-1.15l-.3-.18-3.11.82.83-3.04-.2-.31a8.18 8.18 0 01-1.26-4.36c0-4.54 3.7-8.23 8.24-8.23a8.18 8.18 0 015.82 2.41 8.17 8.17 0 012.41 5.83c0 4.54-3.7 8.21-8.24 8.21z" />
                            </svg>
                            {{ __('site.actions.chat_whatsapp') }}
                        </span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Everything below the hero sits on the drifting engineering grid. --}}
    <div class="grid-motion bg-white dark:bg-slate-950">
        {{-- Daftar jasa: grid bergaris seperti katalog barang. --}}
        <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="flex flex-wrap items-baseline justify-between gap-3 border-b-2 border-slate-300 pb-4 dark:border-slate-700" data-reveal>
                <h2 class="text-sm font-semibold tracking-[0.16em] text-slate-500 uppercase dark:text-slate-400">
                    {{ __('site.labels.service_list') }}
                </h2>
                <p class="text-sm tabular-nums text-slate-500 dark:text-slate-400">{{ count($services) }} {{ __('site.labels.service_types') }}</p>
            </div>

            <ol class="mt-6 grid gap-[2px] border border-slate-300 bg-slate-300 sm:grid-cols-2 lg:grid-cols-3 dark:border-slate-700 dark:bg-slate-800">
                @foreach ($services as $service)
                    <li data-reveal>
                        <a href="{{ route('layanan.detail', ['slug' => App\Http\Controllers\ServiceDetailController::slugFor($service)]) }}" class="group flex h-full flex-col bg-white p-5 transition-colors duration-300 hover:bg-slate-50 dark:bg-slate-950 dark:hover:bg-slate-900">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-[10px] font-semibold tracking-[0.16em] tabular-nums text-slate-400 uppercase">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <svg class="h-4 w-4 text-slate-300 transition-colors duration-300 group-hover:text-netware-teal dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </div>

                            <h3 class="mt-4 text-sm font-semibold text-netware-navy dark:text-white">{{ $service['name'][app()->getLocale()] ?? $service['name']['id'] }}</h3>
                            <p class="mt-1.5 flex-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $service['description'][app()->getLocale()] ?? $service['description']['id'] }}</p>
                            <span class="mt-3 inline-flex items-center gap-1.5 text-[11px] font-semibold tracking-wide text-netware-teal uppercase">
                                {{ __('services_page.detail_other_link') }}
                                <svg class="h-3 w-3 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>

        {{-- Alur layanan --}}
        <section class="border-y-2 border-slate-300 dark:border-slate-700">
            <div class="mx-auto grid max-w-7xl gap-10 px-5 py-10 sm:px-6 sm:py-12 lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-14">
                <div class="lg:col-span-7" data-reveal>
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-netware-teal"></span>
                        <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.flow') }}</p>
                    </div>

                    <h2 class="mt-4 text-xl leading-snug font-semibold tracking-tight text-netware-navy sm:text-2xl lg:text-3xl dark:text-white">
                        {{ __('site.services_page.flow_title') }}
                    </h2>

                    <ol class="mt-6 divide-y-2 divide-slate-300 border-y-2 border-slate-300 dark:divide-slate-700 dark:border-slate-700">
                        @foreach ($flow as [$title, $description])
                            <li class="flex gap-5 py-5">
                                <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center border border-netware-teal/30 bg-netware-teal/8 text-[11px] font-semibold tabular-nums text-netware-teal">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <div>
                                    <h3 class="text-sm font-semibold text-netware-navy dark:text-white">{{ $title }}</h3>
                                    <p class="mt-1.5 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $description }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>

                <aside class="lg:col-span-5" data-reveal>
                    <div class="border border-netware-navy/20 bg-netware-navy p-6 text-white dark:border-slate-700 dark:bg-slate-900">
                        <p class="text-[10px] font-semibold tracking-[0.18em] text-white/50 uppercase">{{ __('site.labels.flow') }}</p>
                        <h3 class="mt-3 text-lg leading-snug font-semibold">{{ __('site.services_page.aside_title') }}</h3>
                        <p class="mt-3 text-xs leading-relaxed text-white/70">
                            {{ __('site.services_page.aside_body') }}
                        </p>
                        <a
                            href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-5 inline-flex items-center gap-2 bg-white px-5 py-2.5 text-sm font-medium text-netware-navy transition-colors duration-200 hover:bg-white/90"
                        >
                            {{ __('site.actions.consult_whatsapp') }}
                        </a>
                    </div>

                    {{-- Fills the remaining height so the column never ends in dead space. --}}
                    <div class="mt-3 border border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900">
                        <div class="border-b border-slate-300 px-4 py-3 dark:border-slate-700">
                            <p class="text-[10px] font-semibold tracking-[0.18em] text-slate-500 uppercase dark:text-slate-400">{{ __('site.services_page.checklist_title') }}</p>
                        </div>

                        <ol class="divide-y divide-slate-300 dark:divide-slate-700">
                            @foreach ([__('site.services_page.checklist_1'), __('site.services_page.checklist_2')] as $entry)
                                <li class="flex items-start gap-3 px-4 py-3">
                                    <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-netware-teal" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                    <span class="text-xs leading-relaxed text-slate-600 dark:text-slate-400">{{ $entry }}</span>
                                </li>
                            @endforeach
                        </ol>

                        <p class="border-t border-slate-300 bg-slate-50 px-4 py-3 text-[11px] leading-relaxed text-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-400">
                            {{ __('site.services_page.checklist_note') }}
                        </p>
                    </div>
                </aside>
            </div>
        </section>

        {{-- Ajakan --}}
        <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="flex flex-wrap items-center justify-between gap-6 border border-slate-300 px-6 py-7 sm:px-8 dark:border-slate-700" data-reveal>
                <div class="max-w-xl">
                    <h2 class="text-lg font-semibold text-netware-navy sm:text-xl dark:text-white">
                        {{ __('site.services_page.cta_title') }}
                    </h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                        {{ __('site.services_page.cta_body') }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 bg-netware-navy px-5 py-2.5 text-sm font-medium text-white transition-colors duration-200 hover:bg-netware-blue"
                    >
                        {{ __('site.actions.chat_whatsapp') }}
                    </a>
                    <a
                        href="https://instagram.com/{{ config('netware.instagram') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 border border-slate-300 px-5 py-2.5 text-sm font-medium text-netware-navy transition-colors duration-200 hover:border-netware-teal hover:text-netware-teal dark:border-slate-700 dark:text-white"
                    >
                        Instagram
                    </a>
                </div>
            </div>
        </section>
    </div>

@endsection

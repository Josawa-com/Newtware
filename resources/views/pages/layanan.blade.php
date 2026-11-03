@extends('layouts.app')

@section('title', __('site.nav.services'))

@section('description', __('site.services_page.lead'))

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-200/70 bg-netware-mist dark:border-slate-800 dark:bg-slate-900">
        <div class="orb-drift pointer-events-none absolute -top-32 right-0 h-80 w-80 rounded-full bg-netware-teal/15 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl gap-8 px-5 py-10 sm:gap-10 sm:px-6 sm:py-14 lg:grid-cols-12 lg:gap-14 lg:px-8 lg:py-16">
            <div class="lg:col-span-7" data-reveal>
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.services') }}</p>
                </div>

                <h1 class="mt-4 text-[2rem] leading-[1.12] font-semibold tracking-tight text-netware-navy sm:mt-5 sm:text-4xl sm:leading-[1.08] lg:text-5xl dark:text-white">
                    {{ __('site.services_page.title_1') }}<br>{{ __('site.services_page.title_2') }}
                </h1>

                <p class="mt-5 max-w-xl text-base leading-relaxed text-slate-600 sm:mt-6 sm:text-lg dark:text-slate-400">
                    {{ __('site.services_page.lead') }}
                </p>
            </div>

            <div class="lg:col-span-5 lg:pt-8" data-reveal>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center gap-3">
                        <span class="h-px w-6 bg-netware-teal"></span>
                        <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.hours') }}</p>
                    </div>

                    <dl class="mt-5 space-y-3">
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="text-sm text-slate-500">{{ __('site.labels.open') }}</dt>
                            <dd class="text-sm font-medium text-netware-navy dark:text-white">{{ config('netware.hours.open') }} {{ config('netware.hours.timezone') }}</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="text-sm text-slate-500">{{ __('site.labels.close') }}</dt>
                            <dd class="text-sm font-medium text-netware-navy dark:text-white">{{ config('netware.hours.close') }} {{ config('netware.hours.timezone') }}</dd>
                        </div>
                    </dl>

                    <p class="mt-5 rounded-lg bg-netware-sand px-4 py-3 text-xs leading-relaxed text-amber-900 dark:bg-amber-500/10 dark:text-amber-200/90">
                        {{ config('netware.hours.note') }}
                    </p>

                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-4 flex items-center justify-between gap-3 border-t border-slate-200 pt-4 text-sm font-medium text-netware-navy transition-colors duration-200 hover:text-netware-teal dark:border-slate-800 dark:text-white"
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

    {{-- Daftar jasa --}}
    <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-16">
        <div class="flex items-center gap-3" data-reveal>
            <span class="h-px w-8 bg-netware-teal"></span>
            <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.service_list') }}</p>
        </div>

        <ol class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (config('netware.services') as $service)
                <li
                    class="group rounded-xl border border-slate-200 bg-white p-5 transition-all duration-300 hover:-translate-y-1 hover:border-netware-teal/40 hover:shadow-[0_24px_45px_-32px_rgba(51,80,149,0.5)] sm:p-6 dark:border-slate-800 dark:bg-slate-900 dark:hover:border-netware-teal/60"
                    data-reveal
                >
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-xs font-semibold tracking-[0.18em] text-slate-300 transition-colors duration-300 group-hover:text-netware-teal dark:text-slate-600">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-netware-mist text-netware-teal transition-colors duration-300 group-hover:bg-netware-teal group-hover:text-white dark:bg-slate-800">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        </span>
                    </div>

                    <h2 class="mt-6 text-base font-semibold text-netware-navy dark:text-white">{{ $service['name'] }}</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $service['description'] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- Alur layanan --}}
    <section class="border-y border-slate-200 bg-slate-50/70 dark:border-slate-800 dark:bg-slate-900/40">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 py-10 sm:px-6 sm:py-14 lg:grid-cols-12 lg:gap-14 lg:px-8 lg:py-16">
            <div class="lg:col-span-7" data-reveal>
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.flow') }}</p>
                </div>

                <h2 class="mt-4 text-xl leading-snug font-semibold tracking-tight text-netware-navy sm:mt-5 sm:text-2xl lg:text-3xl dark:text-white">
                    {{ __('site.services_page.flow_title') }}
                </h2>

                <ol class="mt-8">
                    @foreach ([
                        [__('site.services_page.flow_1_title'), __('site.services_page.flow_1_body')],
                        [__('site.services_page.flow_2_title'), __('site.services_page.flow_2_body')],
                        [__('site.services_page.flow_3_title'), __('site.services_page.flow_3_body')],
                    ] as [$title, $description])
                        <li class="flex gap-5 border-t border-slate-200 py-6 last:border-b dark:border-slate-800">
                            <span class="mt-1 text-xs font-semibold tracking-[0.18em] text-slate-300 dark:text-slate-600">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <h3 class="text-base font-semibold text-netware-navy dark:text-white">{{ $title }}</h3>
                                <p class="mt-1.5 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $description }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

            <aside class="lg:col-span-5 lg:pt-14" data-reveal>
                <div class="rounded-2xl bg-netware-navy p-6 text-white sm:p-7 dark:bg-slate-900 dark:ring-1 dark:ring-white/10">
                    <h3 class="text-lg font-semibold">{{ __('site.services_page.aside_title') }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-white/70">
                        {{ __('site.services_page.aside_body') }}
                    </p>
                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-6 inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-medium text-netware-navy transition-colors duration-200 hover:bg-white/90"
                    >
                        {{ __('site.actions.consult_whatsapp') }}
                    </a>
                </div>
            </aside>
        </div>
    </section>

    {{-- Ajakan --}}
    <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-14">
        <div class="flex flex-wrap items-center justify-between gap-6 rounded-2xl border border-slate-200 bg-white px-6 py-7 sm:px-10 sm:py-8 dark:border-slate-800 dark:bg-slate-900" data-reveal>
            <div class="max-w-xl">
                <h2 class="text-lg font-semibold text-netware-navy sm:text-xl lg:text-2xl dark:text-white">
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
                    class="inline-flex items-center gap-2 rounded-full bg-netware-navy px-6 py-3 text-sm font-medium text-white transition-colors duration-200 hover:brightness-110"
                >
                    {{ __('site.actions.chat_whatsapp') }}
                </a>
                <a
                    href="https://instagram.com/{{ config('netware.instagram') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 rounded-full border border-slate-300 px-6 py-3 text-sm font-medium text-netware-navy transition-colors duration-200 hover:border-netware-teal hover:text-netware-teal dark:border-slate-700 dark:text-white dark:hover:border-netware-teal"
                >
                    Instagram
                </a>
            </div>
        </div>
    </section>
@endsection
